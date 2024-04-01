@extends('layouts.app')
@section('content')
<div class="row m-6">
    <form class="m-3" action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-4" >
                <p class="bg-warning">
                    <span><img src="{{ asset('img/licence_base.png') }}" alt="Blue section"></span>
                    <span style="font-size: 150%;" class=" font-size-lg text-uppercase">{{ $license }}</span>
                </p>
            </div>            
        </div>

        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="brand" class="col-sm-2 col-form-label text-end">Brand</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Car brand" name="brand" id="brand">
            </div>
            @error('brand')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="model" class="col-sm-2 col-form-label text-end">model</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Car model" name="model" id="model">
            </div>
            @error('model')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="price" class="col-sm-2 col-form-label text-end">Car Price</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Car price" class="form-control" step="1" id="price" name="price">
            </div>
            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="mileage" class="col-sm-2 col-form-label text-end">Car Mileage</label>
            <div class="col-sm-2">
                <input value="{{ old('mileage') }}" type="number" placeholder="Current car mileage" class="form-control" step="1" id="mileage" name="mileage">
            </div>
            @error('mileage')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="seats" class="col-sm-2 col-form-label text-end">Car seats</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car seats" class="form-control" step="1" id="seats" name="seats">
            </div>
            @error('seats')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="doors" class="col-sm-2 col-form-label text-end">Car doors</label>
            <div class="col-sm-2">
                <input type="number" placeholder="Current car doors" class="form-control" step="1" id="doors" name="doors">
            </div>
            @error('doors')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="production_year" class="col-sm-2 col-form-label text-end">Car production year</label>
            <div class="col-sm-2">
                <input type="number" id="production_year" step="1" name="production_year" min="1900" max="2100">
            </div>
            @error('production_year')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="weight" class="col-sm-2 col-form-label text-end">Car weight</label>
            <div class="col-sm-2">
                <input type="number" id="weight" step="1" name="weight">
            </div>
            @error('weight')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="color" class="col-sm-2 col-form-label text-end">Car color</label>
            <div class="col-sm-2">
                <input type="color" id="color" name="color">
            </div>
            @error('color')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="image" class="col-sm-2 col-form-label text-end">Car image</label>
            <div class="col-sm-2">
                <input type="file" id="image" name="image" accept="image/*" >
            </div>
            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="tags">Select Tags:</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
                @error('tags')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-2">
                <input type="hidden" name="license" value="{{ $license}}">
            </div>
            @error('license')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-2 text-start">
                <!-- <button>Submit (buttons)</button> -->
                <input type="submit" value="Submit (input-tags)">
            </div>
        </div>
    </form>
</div>
@endsection