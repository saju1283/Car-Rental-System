@extends('frontend.layout')

@section('content')
    <div class="container">
        <div class="header">
            <h2>Your Rental Confirmation</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $rental->user->name }},</p>
            
            <p>Thank you for renting with us! Here are your rental details:</p>
            
            <h3>Car Details</h3>
            <p><strong>Vehicle:</strong> {{ $rental->car->brand }} {{ $rental->car->model }}</p>
            <p><strong>Type:</strong> {{ $rental->car->car_type }}</p>
            <p><strong>Year:</strong> {{ $rental->car->year }}</p>
            
            <h3>Rental Period</h3>
            <p><strong>Pickup Date:</strong> {{ \Carbon\Carbon::parse($rental->start_date)->format('F j, Y') }}</p>
            <p><strong>Return Date:</strong> {{ \Carbon\Carbon::parse($rental->end_date)->format('F j, Y') }}</p>
            <p><strong>Total Days:</strong> {{ \Carbon\Carbon::parse($rental->start_date)->diffInDays(\Carbon\Carbon::parse($rental->end_date)) + 1 }}</p>
            
            <h3>Payment Information</h3>
            <p><strong>Daily Rate:</strong> ${{ number_format($rental->car->daily_rent_price, 2) }}</p>
            <p><strong>Total Cost:</strong> ${{ number_format($rental->total_cost, 2) }}</p>
        </div>
    </div>
@endsection