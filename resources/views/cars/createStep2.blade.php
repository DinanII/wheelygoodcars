@extends('layouts.app')
@section('content')
<div class="row m-6">
    <form class="m-3" action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="row mb-3 justify-content-center">
            <label for="brand" class="col-sm-2 col-form-label text-end">Brand</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Car brand" name="brand" id="brand">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="model" class="col-sm-2 col-form-label text-end">model</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Car model" name="model" id="model">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="price" class="col-sm-2 col-form-label text-end">Car Price</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Car price" class="form-control" step="1" id="price" name="price">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="mileage" class="col-sm-2 col-form-label text-end">Car Mileage</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car mileage" class="form-control" step="1" id="mileage" name="mileage">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="mileage" class="col-sm-2 col-form-label text-end">Car Mileage</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car mileage" class="form-control" step="1" id="mileage" name="mileage">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="seats" class="col-sm-2 col-form-label text-end">Car seats</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car seats" class="form-control" step="1" id="seats" name="seats">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="doors" class="col-sm-2 col-form-label text-end">Car doors</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car doors" class="form-control" step="1" id="doors" name="doors">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="production_year" class="col-sm-2 col-form-label text-end">Car production year</label>
            <div class="col-sm-2">
                <input type="number" id="production_year" step="1" name="production_year" min="1900" max="2100">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="weight" class="col-sm-2 col-form-label text-end">Car weight</label>
            <div class="col-sm-2">
                <input type="number" id="weight" step="1" name="weight">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="color" class="col-sm-2 col-form-label text-end">Car color</label>
            <div class="col-sm-2">
                <input type="color" id="color" name="color">
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="image" class="col-sm-2 col-form-label text-end">Car image</label>
            <div class="col-sm-2">
                <input type="file" id="image" name="image" accept="image/*" >
            </div>
        </div>
        
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-2 text-start">
                <button type="submit">Next step</button>
            </div>
        </div>
    </form>
</div>
@endsection