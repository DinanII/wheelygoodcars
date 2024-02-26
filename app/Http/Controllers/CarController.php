<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Tag;
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
    public function createStep2(Request $request) {
        $request->validate([
            'licence' => ['required', 'string', 'max:255'],
        ]);

        $licence = $request->input('licence');
        $tags = Tag::all();
        return view('cars.createStep2',compact('tags','licence'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
