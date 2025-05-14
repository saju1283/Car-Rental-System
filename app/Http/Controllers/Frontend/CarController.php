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
        $validated = $request->validate([
            'brand' => 'nullable|string',
            'car_type' => 'nullable|string',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
        ]);

        $query = Car::query()->where('availability', true);

        // Apply filters with proper empty checks
        if ($request->filled('brand')) {
            $query->where('brand', 'LIKE', $request->brand);
        }

        if ($request->filled('car_type')) {
            $query->where('car_type', 'LIKE', $request->car_type);
        }

        // Price range validation
        if ($request->filled('min_price') && $request->filled('max_price')) {
            if ($request->min_price > $request->max_price) {
                return redirect()->back()->withErrors(['min_price' => 'Minimum price cannot be greater than maximum price']);
            }
        }

        if ($request->filled('min_price')) {
            $query->where('daily_rent_price', '>=', (float)$request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('daily_rent_price', '<=', (float)$request->max_price);
        }

        $cars = $query->paginate(9)
                    ->appends($request->except('page'));

        $brands = Car::distinct()->pluck('brand');
        $carTypes = Car::distinct()->pluck('car_type');

        return view('frontend.cars.index', compact('cars', 'brands', 'carTypes'));
    }
    public function show(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }
}