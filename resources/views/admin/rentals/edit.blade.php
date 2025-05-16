
@extends('admin.layout')

@section('title', 'Edit Rental')

@section('content')
<div class="container mt-4">
    <h2>Edit Rental #{{ $rental->id }}</h2>

    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <input type="text" class="form-control" value="{{ $rental->user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Car</label>
            <input type="text" class="form-control" value="{{ $rental->car->brand }} {{ $rental->car->model }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $rental->start_date->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $rental->end_date->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Cost</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" value="{{ $rental->total_cost }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="ongoing" {{ $rental->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $rental->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection
