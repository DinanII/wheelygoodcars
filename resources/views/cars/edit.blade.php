@extends('layouts.app')
@section('content')
<div class="row m-6">
    <form class="m-3" action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-4">
                <p class="bg-warning">
                    <span><img src="{{ asset('img/licence_base.png') }}" alt="Blue section"></span>
                    <span style="font-size: 150%;" class=" font-size-lg text-uppercase">{{ $car->license_plate }}</span>
                </p>
            </div>
          
        </div>
        

        <div class="row mb-3 justify-content-center">
            <div>
                <img src="{{ asset('storage/'.$car->image) }}" alt="Image of a {{ $car->model }} from {{ $car->user->name }}" style="width: 300px; height: 200px;"><br />
            </div>  
            <label for="license_plate" class=" col-form-label text-start">License</label>
            <div class="">
                <input type="text" class="form-control" placeholder="Car license" name="license" id="license_plate" value="{{ $car->license_plate }}">
            </div>
            @error('brand')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <label for="brand" class=" col-form-label text-start">Brand</label>
            <div class="">
                <input type="text" class="form-control" placeholder="Car brand" name="brand" id="brand" value="{{ $car->make }}">
            </div>
            @error('brand')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="model" class=" col-form-label text-start">Model</label>
            <div class="">
                <input type="text" class="form-control" placeholder="Car model" name="model" id="model" value="{{ $car->model }}">
            </div>
            @error('model')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="price" class=" col-form-label text-start">Car Price</label>
            <div class="">
                <input type="number" placeholder="Car price" class="form-control" step="1" id="price" name="price" value="{{ $car->price }}">
            </div>
            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="mileage" class=" col-form-label text-start">Car Mileage</label>
            <div class="">
                <input value="{{ $car->mileage }}" type="number" placeholder="Current car mileage" class="form-control" step="1" id="mileage" name="mileage">
            </div>
            @error('mileage')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="seats" class=" col-form-label text-start">Car Seats</label>
            <div class="">
                <input type="number" placeholder="Current car seats" class="form-control" step="1" id="seats" name="seats" value="{{ $car->seats }}">
            </div>
            @error('seats')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="doors" class=" col-form-label text-start">Car Doors</label>
            <div class="">
                <input type="number" placeholder="Current car doors" class="form-control" step="1" id="doors" name="doors" value="{{ $car->doors }}">
            </div>
            @error('doors')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="production_year" class=" col-form-label text-start">Car Production Year</label>
            <div class="">
                <input type="number" id="production_year" step="1" name="production_year" min="1900" max="2100" value="{{ $car->production_year }}">
            </div>
            @error('production_year')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="weight" class=" col-form-label text-start">Car Weight</label>
            <div class="">
                <input type="number" id="weight" step="1" name="weight" value="{{ $car->weight }}">
            </div>
            @error('weight')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="color" class=" col-form-label text-start">Car Color</label>
            <div class="">
                <input type="color" id="color" name="color" value="{{ $car->color }}">
            </div>
            @error('color')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mb-3 justify-content-center">
            <label for="image" class=" col-form-label text-start">Car Image</label>
            <div class="">
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
                <input type="text" id="newTagInput" placeholder="Add a new tag">
                <button type="button" onclick="addNewTag()">Add Tag</button>
                @error('tags')
                    <p>{{ $message }}</p>
                @enderror
                @error('tags')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-2">
                <input type="hidden" name="license" value="{{ $car->license}}">
            </div>
            @error('car->license')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div class="row mt-3 justify-content-center">
            <div class="">
                <input type="submit" value="Update Car">
            </div>
        </div>
    </form>
    <script>
    function addNewTag() {
        var newTagInput = document.getElementById('newTagInput');
        var newTagName = newTagInput.value.trim();
        
        if (newTagName !== '') {
            var tagsSelect = document.getElementById('tags');
            var newOption = document.createElement('option');
            newOption.value = ''; // You can set the value to something meaningful
            newOption.text = newTagName;
            tagsSelect.add(newOption);

            // Clear the input field after adding the tag
            newTagInput.value = '';
        }
    }
</script>
</div>
@endsection
