@extends('layouts.app')
@section('content')
<div class="container d-flex align-items-center justify-content-center p-4">

    <div>
        <a class="btn btn-primary mt-6" href="{{ route('cars.create') }}">New Car</a>
    </div>
</div>
<div class="row m-6">
    @foreach($cars as $car)
    <div class="col-md-4 mb-4">
        <div class="card border border-primary">
            <div class="card-body">
                <h2>{{ $car->model }}</h2>
                <img src="{{ asset('storage/app/public/'.$car->image) }}" alt="Image of a {{ $car->model }} from {{ $car->user->name }}"><br />
                Prijs: <b>&euro;{{ number_format($car->price,2,',','.') }}</b><br />
                Geplaatst door: <p class="card-text">{{ $car->user->name }}</p>
                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Read more</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection