<?php

// app/Http/Controllers/Frontend/CarController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query()->where('availability', true);

        // Apply filters
        if ($request->has('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->has('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        if ($request->has('min_price')) {
            $query->where('daily_rent_price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('daily_rent_price', '<=', $request->max_price);
        }

        $cars = $query->paginate(9);

        $brands = Car::distinct()->pluck('brand');
        $carTypes = Car::distinct()->pluck('car_type');

        return view('frontend.cars.index', compact('cars', 'brands', 'carTypes'));
    }

    public function show(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }
}