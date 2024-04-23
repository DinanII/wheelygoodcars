@extends('layouts.app')
@section('content')
<div class="row m-6">

    <div class="container d-flex align-items-center justify-content-center">
        <div class="card border border-primary" style="min-width: 40%;">
            <div class="card-body container d-flex align-items-center justify-content-center">
                <div>
                    <h2>{{ $car->model }}</h2>
                    <img src="{{ asset('storage/'.$car->image) }}" alt="Image of a {{ $car->model }} from {{ $car->user->name }}" style="width: 300px; height: 200px;"><br />
                    Prijs: <b>&euro;{{ number_format($car->price,2,',','.') }}</b><br />
                    Geplaatst door: <p class="card-text">{{ $car->user->name }}</p>
                    @if (Auth::user()->id == $car->user_id)
                    <div class="container d-flex align-items-center justify-content-center">
                        <p>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning ms-2">Edit</a>
                        </p>
                        <p>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger ms-2" type="submit" value="Delete">
                        </form>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card mt-6">
                <h2 class="m-2">
                    <div class="container d-flex align-items-center justify-content-center mb-4 mt-4">
                        <h2>Tags</h2>
                    </div>
                </h2>

                <div class="container d-flex align-items-center justify-content-center mb-4 mt-4">
                    @foreach($car->tags as $tag)
                    <span class="badge bg-primary m-1">
                        <h5 class="text-white m-1">{{ $tag->name }}</h5>
                    </span>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
