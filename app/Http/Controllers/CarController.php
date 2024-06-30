<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Tag;
use PharIo\Manifest\License;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
        }
    public function profile($userId)
    {
        try {
            // Retrieve cars with associated tags, belonging to specified user
            $cars = Car::with('tags')->where('user_id', $userId)->get();
            return view('cars.ownCars', compact('cars'));
        } catch (\Exception $e) {
            dd($e->getMessage());  // Display the error message
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return view("cars.create");
    }
    public function validateLicense(Request $request) {
        $request->validate([
            'license' => ['required', 'string', 'max:255'],
        ]);

        $license = $request->input('license');
        $succes = 'License succesfully updated!';
        
        //return redirect()->route('cars.create.carInfo',compact('license','succes'));
        //return $this->create2Form($license);
        return redirect()->route('cars.create.carInfo', ['license' => $license]);


    }

    public function create2Form($license) {
        $rdwResponse = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$license}")->json();
        
        if (!empty($rdwResponse)) { 
            $rdwData = $rdwResponse[0];
            if ($rdwData['tweede_kleur'] === 'Niet geregistreerd') {
                $color = $rdwData['eerste_kleur'];
            }
            else {
                $color = $rdwData['tweede_kleur'];
            }
        } else {
            $color = '';
            $rdwData = [];
        }

            $brand = $rdwData['merk'] ?? '';
            $model = $rdwData['handelsbenaming'] ?? '';
            $price = $rdwData['catalogusprijs'] ?? '';
            $doors = $rdwData['aantal_deuren'] ?? '';
            $weight = $rdwData['massa_rijklaar'] ?? '';
            $seats = $rdwData['aantal_zitplaatsen'] ?? '';
            $color = '';

            //$license = $rdwData['license'];
            


        $tags = Tag::all();
        return view('cars.createStep2', compact('seats','tags','license','rdwData','brand','model','price','doors','weight','color'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'license' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|integer',
            'mileage' => 'required|integer',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'production_year' => 'required|integer',
            'weight' => 'required|integer',
            'color' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,gif|max:10240',
            // 'tags' => 'required|array', // Add validation rule for tags
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('img/cars', 'public');

        // Create a new car instance
        $nCar = new Car();

        // Assign values from the request to the car instance
        $nCar->user_id = auth()->user()->id;
        $nCar->license_plate = $request->input('license');
        $nCar->make = $request->input('brand');
        $nCar->model = $request->input('model');
        $nCar->price = $request->input('price');
        $nCar->mileage = $request->input('mileage');
        $nCar->seats = $request->input('seats');
        $nCar->doors = $request->input('doors');
        $nCar->production_year = $request->input('production_year');
        $nCar->weight = $request->input('weight');
        $nCar->color = $request->input('color');
        $nCar->image = $imagePath;

        // Save the car instance to the database
        $nCar->save();
if (is_array($request->input('tags'))) {
    // Attach tags to the car
    $tags = $request->input('tags');
    foreach ($tags as $tag) {
        // Try to decode the tag as JSON
        $decodedTag = json_decode($tag);
        
        if (json_last_error() == JSON_ERROR_NONE) {
            // If it's a valid JSON, check if it's an object
            if (is_object($decodedTag)) {
                $existingTag = Tag::where('name', $decodedTag->name)->first();
                if ($existingTag) {
                    $nCar->tags()->attach($existingTag);
                } else {
                    $newTag = new Tag();
                    $newTag->name = $decodedTag->name;
                    $newTag->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $newTag->save();
                    $nCar->tags()->attach($newTag);
                }
            } else {
                // Handle other types if necessary
                // For now, let's assume it's not valid and continue
                continue;
            }
        } else {
            // If it's not a valid JSON, treat it as a string
            if (is_string($tag)) {
                $existingTag = Tag::where('name', $tag)->first();
                if ($existingTag) {
                    $nCar->tags()->attach($existingTag);
                } else {
                    $newTag = new Tag();
                    $newTag->name = $tag;
                    $newTag->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $newTag->save();
                    $nCar->tags()->attach($newTag);
                }
            } else {
                // Attach as is if it's neither a string nor a JSON object
                $nCar->tags()->attach($tag);
            }
        }
    }
}


        try {
            // Retrieve cars with associated tags, belonging to specified user
            $userId = auth()->id();
            $cars = Car::with('tags')->where('user_id', $userId)->get();
            return view('cars.ownCars', compact('cars'));
        } catch (\Exception $e) {
            dd($e->getMessage());  // Display the error message
        }

        // Redirect to user's profile page
        // try {
        //     // Retrieve cars with associated tags, belonging to specified user
        //     $cars = Car::with('tags')->where('user_id', $userId)->get();
        //     return view('cars.ownCars', compact('cars'));
        // } catch (\Exception $e) {
        //     dd($e->getMessage());  // Display the error message
        // }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::with('tags')->where('id', $id)->firstOrFail();
        return view('cars.detail', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::with('tags')->where('id', $id)->firstOrFail();
        $tags = Tag::all();
        return view('cars.edit', compact('car','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|integer',
            'mileage' => 'required|integer',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'production_year' => 'required|integer',
            'weight' => 'required|integer',
            'color' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:10240'
        ]);

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if (Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }

            // Store the new image file
            $imagePath = $request->file('image')->store('img/cars', 'public');
            $car->image = $imagePath;
        }

        $car->make = $request->input('brand');
        $car->model = $request->input('model');
        $car->price = $request->input('price');
        $car->mileage = $request->input('mileage');
        $car->seats = $request->input('seats');
        $car->doors = $request->input('doors');
        $car->production_year = $request->input('production_year');
        $car->weight = $request->input('weight');
        $car->color = $request->input('color');
        $car->save();



        // Attach tags to the car
        $tags = $request->input('tags');
        foreach($tags as $tag) {
            if(is_string($tag)) {
                $tag = new Tag();
                $tag->name = 'tag';
                $tag->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $tag->save();
                $nCar->tags()->attach($tag);
            }
            else {
                $nCar->tags()->attach($tag);
            }
        }

        try {
            // Retrieve cars with associated tags, belonging to specified user
            $userId = auth()->id();
            $cars = Car::with('tags')->where('user_id', $userId)->get();
            return view('cars.ownCars', compact('cars'));
        } catch (\Exception $e) {
            dd($e->getMessage());  // Display the error message
        }
        // // Sync tags
        // $tags = $request->input('tags');
        // $car->tags()->sync($tags);

        //         try {
        //     // Retrieve cars with associated tags, belonging to specified user
        //     $cars = Car::with('tags')->where('user_id', $userId)->get();
        //     return view('cars.ownCars', compact('cars'));
        // } catch (\Exception $e) {
        //     dd($e->getMessage());  // Display the error message
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return view('cars.index', compact('car'));
    }
}
