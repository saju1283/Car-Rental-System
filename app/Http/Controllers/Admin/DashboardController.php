<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalCars' => Car::count(),
            'availableCars' => Car::where('availability', true)->count(),
            'totalRentals' => Rental::count(),
            'totalEarnings' => Rental::where('status', 'completed')->sum('total_cost'),
            'recentRentals' => Rental::with(['user', 'car'])->latest()->take(5)->get()
        ]);
    }

    public function testDashboard()
    {
        return view('admin.test-dashboard', [
            'totalCars' => Car::count(),
            'recentRentals' => Rental::with(['user', 'car'])->latest()->take(5)->get()
        ]);
    }

}

