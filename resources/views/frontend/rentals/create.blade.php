@extends('frontend.layout')

@section('title', 'Rent a Car')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Rent {{ $car->name }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.rentals.store', $car->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Car Details</h5>
                                        @if($car->image)
                                            <img src="{{ asset('images/car_images/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid rounded mb-3">
                                        @endif
                                        <p class="card-text">
                                            <strong>Brand:</strong> {{ $car->brand }}<br>
                                            <strong>Model:</strong> {{ $car->model }}<br>
                                            <strong>Type:</strong> {{ $car->car_type }}<br>
                                            <strong>Daily Price:</strong> ${{ number_format($car->daily_rent_price, 2) }}
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                           id="start_date" name="start_date" 
                                           min="{{ date('Y-m-d') }}" 
                                           value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                           id="end_date" name="end_date" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                           value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="totalcost" class="form-label">Total Cost</label>
                                    <p id="totalcost" class="form-control-plaintext">$0.00</p>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dailyPrice = parseFloat("{{ $car->daily_rent_price }}");
        const startDateEl = document.getElementById('start_date');
        const endDateEl = document.getElementById('end_date');
        const totalCostEl = document.getElementById('totalcost');

        const calculateRentalCost = function () {
            if (startDateEl.value && endDateEl.value) {
                const start = new Date(startDateEl.value);
                const end = new Date(endDateEl.value);
                const days = (end - start) / (1000 * 60 * 60 * 24);
                const total = days * dailyPrice;
                totalCostEl.textContent = `$${total.toFixed(2)}`;
            }
        };

        startDateEl.addEventListener('change', function () {
            totalCostEl.textContent = '$0.00';
        });

        endDateEl.addEventListener('change', calculateRentalCost);
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const disabledDates = @json($disabledDates ?? []);

        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            disable: disabledDates,
            minDate: "today"
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            disable: disabledDates,
            minDate: "today"
        });
    });
</script>

@endsection
