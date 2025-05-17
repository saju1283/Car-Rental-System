@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')


<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Cars</h5>
                <p class="card-text display-4">{{ $totalCars }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Available Cars</h5>
                <p class="card-text display-4">{{ $availableCars }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Rentals</h5>
                <p class="card-text display-4">{{ $totalRentals }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Total Earnings</h5>
                <p class="card-text display-4">${{ number_format($totalEarnings, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Recent Rentals</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Rental Dates</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                    <td>{{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}</td>
                    <td>${{ number_format($rental->total_cost, 2) }}</td>
                    <td>
                        <span class="badge 
                            @if($rental->status == 'completed') bg-success
                            @elseif($rental->status == 'pending') bg-warning
                            @elseif($rental->status == 'canceled') bg-danger
                            @elseif($rental->status == 'ongoing') bg-dark
                            @endif">
                            {{ ucfirst($rental->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
