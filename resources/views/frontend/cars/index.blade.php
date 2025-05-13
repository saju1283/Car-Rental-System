@extends('frontend.layout')

@section('title', 'Available Cars')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Available Cars</h1>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('frontend.cars.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="brand" class="form-label">Brand</label>
                                <select name="brand" id="brand" class="form-select">
                                    <option value="">All Brands</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="car_type" class="form-label">Car Type</label>
                                <select name="car_type" id="car_type" class="form-select">
                                    <option value="">All Types</option>
                                    @foreach($carTypes as $type)
                                    <option value="{{ $type }}" {{ request('car_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="min_price" class="form-label">Min Price</label>
                                <input type="number" name="min_price" id="min_price" class="form-control" placeholder="$0" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="max_price" class="form-label">Max Price</label>
                                <input type="number" name="max_price" id="max_price" class="form-control" placeholder="$1000" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('frontend.cars.index') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($car->image)
                <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    No Image Available
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $car->name }}</h5>
                    <p class="card-text">
                        <strong>Brand:</strong> {{ $car->brand }}<br>
                        <strong>Model:</strong> {{ $car->model }}<br>
                        <strong>Type:</strong> {{ $car->car_type }}<br>
                        <strong>Year:</strong> {{ $car->year }}<br>
                        <strong>Price:</strong> ${{ number_format($car->daily_rent_price, 2) }}/day
                    </p>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('frontend.cars.show', $car->id) }}" class="btn btn-primary w-100">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
</div>
@endsection