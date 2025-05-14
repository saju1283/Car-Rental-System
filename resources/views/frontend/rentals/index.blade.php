@extends('frontend.layout')

@section('title', 'My Rentals')
@section('content')
<div class="container py-4">
    <h1>My Rentals</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if($rentals->isEmpty()))
        <div class="alert alert-info">
            You haven't made any rentals yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Rental Period</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentals as $rental)
                    <tr>
                        <td>
                            @if($rental->car)
                                {{ $rental->car->brand }} {{ $rental->car->model }}
                            @else
                                [Deleted Car]
                            @endif
                        </td>
                        <td>
                            {{ $rental->start_date->format('M j, Y') }} - 
                            {{ $rental->end_date->format('M j, Y') }}
                        </td>
                        <td>${{ number_format($rental->total_cost, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $rental->status === 'completed' ? 'success' : 
                                ($rental->status === 'canceled' ? 'danger' : 'warning') 
                            }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                        <td>
                            @if($rental->status === 'pending')
                                <form action="{{ route('frontend.rentals.cancel', $rental) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to cancel this rental?')">
                                        Cancel
                                    </button>
                                </form>
                                @if(Route::has('frontend.rentals.show'))
                                    <a href="{{ route('frontend.rentals.show', $rental) }}" class="btn btn-sm btn-primary ms-1">
                                        View
                                    </a>
                                @endif
                            @elseif($rental->status === 'completed' || $rental->status === 'canceled')
                                @if(Route::has('frontend.rentals.show'))
                                    <a href="{{ route('frontend.rentals.show', $rental) }}" class="btn btn-sm btn-primary">
                                        View Details
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $rentals->links() }}
        </div>
    @endif
</div>
@endsection