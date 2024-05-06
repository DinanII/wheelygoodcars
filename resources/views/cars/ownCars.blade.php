@extends('layouts.app')
@section('content')
<div class="row text-center" style="width: 80%; margin: 2% auto;" >
        <div class="table-responsive">
                @if(!$cars || count($cars) < 1)
                <div class="text-danger" >
                    No cars available.
                </div>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Posted By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->model }}</td>
                            <td>
                                <img src="{{ Storage::url($car->image) }}" style="max-width: 150px; max-height: 100px;">
                            </td>
                            <td>&euro;{{ number_format($car->price, 2, ',', '.') }}</td>
                            <td>{{ $car->user->name }}</td>
                            <td>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Read more</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

        </div>
    </div>
</div>
@endsection