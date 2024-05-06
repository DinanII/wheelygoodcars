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
        return $this->create2Form($license);

    }

    public function create2Form($license) {
        $rdwResponse = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$license}")->json();
        
        if (!empty($rdwResponse)) {
            $rdwData = $rdwResponse[0];
            $brand = $rdwData['merk'];
            $model = $rdwData['handelsbenaming'];
            $price = $rdwData['catalogusprijs'];
            $doors = $rdwData['aantal_deuren'];
            $weight = $rdwData['massa_rijklaar'];
            $color = '';
            if ($rdwData['tweede_kleur'] === 'Niet geregistreerd') {
                $color = $rdwData['eerste_kleur'];
            }
            else {
                $color = $rdwData['tweede_kleur'];
            }
            //$license = $rdwData['license'];
            $seats = $rdwData['aantal_zitplaatsen'];
        } else {
            $rdwData = null;
        }

        $tags = Tag::all();
        return view('cars.createStep2', compact('seats','tags','license','rdwData','brand','model','price','doors','weight','color'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        request()->validate([
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
            'image' => 'required|image|mimes:jpeg,png,gif|max:10240'
        ]);

        $imagePath = $request->file('image')->store('img/cars', 'public');
        $nCar = new Car();
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
        $nCar->save();
        $tags = $request->input('tags');
        foreach ($tags as $tagId) {
            $nCar->tags()->attach($tagId);

        }
        return $this->profile(auth()->user()->id);
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

        // Sync tags
        $tags = $request->input('tags');
        $car->tags()->sync($tags);

        return $this->profile(auth()->user()->id);
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
