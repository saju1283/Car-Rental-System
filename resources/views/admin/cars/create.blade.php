@extends('admin.layout')

@section('title', 'Add New Car')

@section('content')
<div class="container mt-4">
    <h2>Add New Car</h2>

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Car Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year of Manufacture</label>
            <input type="number" name="year" id="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="car_type" class="form-label">Car Type</label>
            <input type="text" name="car_type" id="car_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
            <input type="number" name="daily_rent_price" id="daily_rent_price" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="availability" class="form-label">Availability</label>
            <select name="availability" id="availability" class="form-control" required>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Car Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Add Car</button>
    </form>
</div>
@endsection
