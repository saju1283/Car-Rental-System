
@extends('admin.layout')

@section('title', 'Customer Details')

@section('content')
<div class="container mt-4">
    <h2>Customer Profile</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone Number:</strong> {{ $customer->phone }}</p>
            <p><strong>Address:</strong> {{ $customer->address }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Rental History</strong>
        </div>
        <div class="card-body table-responsive">
            @if($customer->rentals->isEmpty())
                <p>No rentals found for this customer.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Car</th>
                            <th>Dates</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                            <td>{{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}</td>
                            <td>${{ number_format($rental->total_cost, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($rental->status == 'completed') bg-success
                                    @elseif($rental->status == 'pending') bg-warning
                                    @elseif($rental->status == 'Ongoing') bg-danger
                                    @elseif($rental->status == 'canceled') bg-danger
                                    @endif">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-4">Back to Customers</a>
</div>
@endsection
