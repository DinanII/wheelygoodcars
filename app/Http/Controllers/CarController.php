<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Tag;
use PharIo\Manifest\License;

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
        // Retrieve cars with associated tags, belonging to specified user
        $cars = Car::with('tags')->where('user_id', $userId)->get();

        return view('cars.index', compact('cars'));
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
        // TODO: Insert RWD API functionality
        $license = $request->input('license');
        $succes = 'License succesfully updated!';
        return redirect()->route('cars.create.carInfo',compact('license','succes'));

    }

    public function create2Form($license) {
        $tags = Tag::all();
        return view('cars.createStep2',compact('tags','license'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        request()->validate([
            'license' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|integer|max:255',
            'mileage' => 'required|integer|max:255',
            'seats' => 'required|integer|max:255',
            'doors' => 'required|integer|max:255',
            'production_year' => 'required|integer',
            'weight' => 'required|integer|max:255',
            'color' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,gif|max:10240'
        ]);
        
        //----------------------
        // TODO: Zorg dat de bijgevoegde tags ook opgeslagen worden.
        // Voor iedere tag in tags (array): maak een nieuwe car_tag entry aan,
        // iedere entry moet het ID van de car en de tag bevatten.
        //----------------------

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

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
