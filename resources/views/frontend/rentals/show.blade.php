{{-- resources/views/frontend/rentals/show.blade.php --}}
@extends('frontend.layout')

@section('title', 'Rental Details')
@section('content')
<div class="container py-4">
    <h1>Rental Details</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                @if($rental->car)
                    {{ $rental->car->brand }} {{ $rental->car->model }}
                @else
                    [Deleted Car]
                @endif
            </h5>
            
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Rental Period:</strong> 
                        {{ $rental->start_date->format('M j, Y') }} to 
                        {{ $rental->end_date->format('M j, Y') }}
                    </p>
                    <p><strong>Total Cost:</strong> ${{ number_format($rental->total_cost, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ 
                            $rental->status === 'completed' ? 'success' : 
                            ($rental->status === 'canceled' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($rental->status) }}
                        </span>
                    </p>
                    <p><strong>Booked On:</strong> {{ $rental->created_at->format('M j, Y g:i A') }}</p>
                </div>
            </div>
            
            <a href="{{ route('frontend.rentals.index') }}" class="btn btn-primary mt-3">
                Back to My Rentals
            </a>
        </div>
    </div>
</div>
@endsection