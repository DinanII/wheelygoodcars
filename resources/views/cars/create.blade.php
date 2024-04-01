@extends('layouts.app')
@section('content')
<div class="row m-6">
    <div class="col-12 text-center">
        <h2>Create car</h2>
    </div>  
    <form class="m-3" action="{{ route('cars.create.validateLicense') }}" method="POST">
       
        @csrf
        <div class="row mb-3 justify-content-center">
            <label for="license" class="col-sm-2 col-form-label text-end">Licence Plate</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Current licence plate of this car" name="license" id="license">
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