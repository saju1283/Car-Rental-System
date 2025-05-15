@extends('admin.layout')

@section('title', 'Manage Rentals')

@section('content')
<div class="container mt-4">
    <h2>Rental Management</h2>

    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Rental Dates</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
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
                            @elseif($rental->status == 'Ongoing') bg-danger
                            @elseif($rental->status == 'canceled') bg-danger
                            @endif">
                            {{ ucfirst($rental->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.rentals.show', $rental->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.rentals.edit', $rental->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rentals->links() }}
    </div>
</div>
@endsection
