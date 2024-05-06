@extends('layouts.app')
@section('content')
<div class="row text-center" style="width: 80%; margin: 2% auto;" >
    <!-- <div>
        <a class="btn btn-primary mt-6 m-3" href="{{ route('cars.create') }}">New Car</a>
    </div> -->
    @if(!$cars || count($cars) < 1)
    <div class="text-danger" >
        No cars available.
    </div>
    @endif
    @foreach($cars as $car)
    <div class="col-md-4 mb-4">
        <div class="card border border-primary">
            <div class="card-body">
                @if(count($cars) == 0)
                    <h2>Geen auto's gevonden...</h2>
                @endif
                <h2>{{ $car->model }}</h2>
                <img src="{{ Storage::url($car->image) }}" alt="Image of a {{ $car->model }} from {{ $car->user->name }}" style="width: 300px; height: 200px;"><br />
                Prijs: <b>&euro;{{ number_format($car->price,2,',','.') }}</b><br />
                Geplaatst door: <p class="card-text">{{ $car->user->name }}</p>
                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Read more</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection