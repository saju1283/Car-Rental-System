@extends('frontend.layout')

@section('title', $car->name)
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            @if($car->image)
                <img src="{{ asset('images/car_images/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid rounded">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 300px;">
                    No Image Available
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h1>{{ $car->name }}</h1>
            <p class="text-muted">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</p>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Car Details</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Type:</strong> {{ $car->car_type }}
                        </li>
                        <li class="list-group-item">
                            <strong>Daily Price:</strong> ${{ number_format($car->daily_rent_price, 2) }}
                        </li>
                        <li class="list-group-item">
                            <strong>Availability:</strong>
                            <span class="badge bg-{{ $car->availability ? 'success' : 'danger' }}">
                                {{ $car->availability ? 'Available' : 'Not Available' }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            @auth
         
                <a href="{{ route('frontend.rentals.create', $car->id) }}" class="btn btn-primary btn-lg w-100">
                    Rent This Car
                </a>

            @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}" class="alert-link">Login</a> to rent this car
                </div>
            @endauth
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Description</h5>
                </div>
                <div class="card-body">
                    <p>Experience the comfort and performance of the {{ $car->brand }} {{ $car->model }}. Perfect for your daily commute or long trips.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
