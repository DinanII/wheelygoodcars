@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Car</div>
                <div class="card-body">
                    <strong>Debug</strong>
                    <div>
                            @php
                            echo json_encode($rdwData)
                            @endphp
                            
                    </div>
                    <div>
                        {{ $license. $brand. $model. $price. $doors. $weight. $color. $seats }}
                    </div>
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
                                <input type="text" class="form-control" @isset($brand) value='{{ $brand }}' @endisset  placeholder="Car brand" name="brand" id="brand" >
                            </div>
                            @error('brand')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="model" class="col-sm-2 col-form-label text-end">model</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="Car model" name="model" id="model" @isset($model) value='{{ $model }}' @endisset >
                            </div>
                            @error('model')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="price" class="col-sm-2 col-form-label text-end">Car Price</label>
                            <div class="col-sm-2">
                                <input type="number" placeholder="Car price" class="form-control" step="1" id="price" name="price" @isset($price) value='{{ $price }}' @endisset>
                            </div>
                            @error('price')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="mileage" class="col-sm-2 col-form-label text-end">Car Mileage</label>
                            <div class="col-sm-2">
                                <input value="{{ old('mileage') }}" type="number" placeholder="Current car mileage" class="form-control" step="1" id="mileage" name="mileage" @isset($mileage) value='{{ $mileage }}' @endisset>
                            </div>
                            @error('mileage')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="seats" class="col-sm-2 col-form-label text-end">Car seats</label>
                            <div class="col-sm-2">
                                <input type="number" placeholder="Current car seats" class="form-control" step="1" id="seats" name="seats" @isset($seats) value='{{ $seats }}' @endisset>
                            </div>
                            @error('seats')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="doors" class="col-sm-2 col-form-label text-end">Car doors</label>
                            <div class="col-sm-2">
                                <input type="number" placeholder="Current car doors" class="form-control" step="1" id="doors" name="doors" @isset($doors) value='{{ $doors }}' @endisset >
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
                                <input type="number" id="weight" step="1" name="weight" @isset($weight) value='{{ $weight }}' @endisset>
                            </div>
                            @error('weight')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <label for="color" class="col-sm-2 col-form-label text-end">Car color</label>
                            <div class="col-sm-2">
                                <p class='badge text-bg-primary' >@isset($color) {{ $color }} @endisset</p>
                                <input type="color" id="color" name="color" >
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
                                <input type="hidden" name="license" value="{{ $license}}">
                            </div>
                            @error('license')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-2 text-start">
                                <!-- <button>Submit (buttons)</button> -->
                                <input type="submit" value="Submit form">
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>        
    </div>
</div>
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
@endsection