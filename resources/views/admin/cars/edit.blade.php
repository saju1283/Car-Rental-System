@extends('admin.layout')

@section('title', 'Edit Car')

@section('content')
<div class="container mt-4">
    <h2>Edit Car</h2>

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Car Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $car->name }}" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control" value="{{ $car->brand }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ $car->model }}" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year of Manufacture</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ $car->year }}" required>
        </div>

        <div class="mb-3">
            <label for="car_type" class="form-label">Car Type</label>
            <input type="text" name="car_type" id="car_type" class="form-control" value="{{ $car->car_type }}" required>
        </div>

        <div class="mb-3">
            <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
            <input type="number" name="daily_rent_price" id="daily_rent_price" class="form-control" value="{{ $car->daily_rent_price }}" required>
        </div>

        <div class="mb-3">
            <label for="availability" class="form-label">Availability Status</label>
            <select name="availability" id="availability" class="form-control" required>
                <option value="1" {{ $car->availability ? 'selected' : '' }}>Available</option>
                <option value="0" {{ !$car->availability ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Car Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($car->image)
                <img src="{{ asset('storage/car_images/' . $car->image) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Car</button>
    </form>
</div>
@endsection
