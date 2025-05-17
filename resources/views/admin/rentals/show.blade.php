@extends('admin.layout')

@section('title', 'Rental Details')

@section('content')
<div class="container mt-4">
    <h2>Rental #{{ $rental->id }}</h2>

    <div class="card mt-4">
        <div class="card-header">
            <strong>Rental Info</strong>
        </div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $rental->user->name }}</p>
            <p><strong>Contact Number:</strong> {{ $rental->user->phone_number }}</p>
            <p><strong>Car:</strong> {{ $rental->car->name }} ({{ $rental->car->brand }})</p>
            <p><strong>Rental Dates:</strong> {{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}</p>
            <p><strong>Total Cost:</strong> ${{ number_format($rental->total_cost, 2) }}</p>
            <p>
                <strong>Status:</strong>
                <span class="badge 
                    @if($rental->status == 'completed') bg-success
                    @elseif($rental->status == 'pending') bg-warning
                    @elseif($rental->status == 'canceled') bg-danger
                     @elseif($rental->status == 'ongoing') bg-dark
                    @endif">
                    {{ ucfirst($rental->status) }}
                </span>
            </p>
        </div>
    </div>

    <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary mt-4">Back to Rentals</a>
</div>
@endsection
