@extends('admin.layout')

@section('title', 'Test Dashboard Page')

@section('content')
<h2 class="mb-4">This is a Test Dashboard Page</h2>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Cars</h5>
                <p class="card-text display-4">{{ $totalCars }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Recent Rentals (Test View)</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Dates</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                    <td>{{ $rental->start_date->format('m/d/Y') }} - {{ $rental->end_date->format('m/d/Y') }}</td>
                    <td>${{ number_format($rental->total_cost, 2) }}</td>
                    <td><span class="badge bg-{{ $rental->status_color }}">{{ ucfirst($rental->status) }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
