@extends('frontend.layout')

@section('title', 'Home')
@section('content')
<div class="container py-4">
    <div class="jumbotron bg-light p-5 rounded-lg m-3">
        <h1 class="display-4">Welcome to Car Rental</h1>
        <p class="lead">Find the perfect car for your next adventure</p>
        <hr class="my-4">
        <p>Browse our selection of vehicles and book your ride today.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('frontend.cars.index') }}" role="button">Browse Cars</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-car"></i> Wide Selection</h5>
                    <p class="card-text">Choose from our diverse fleet of vehicles to suit all your needs.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Affordable Rates</h5>
                    <p class="card-text">Competitive pricing with no hidden fees.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-headset"></i> 24/7 Support</h5>
                    <p class="card-text">Our team is always ready to assist you.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection