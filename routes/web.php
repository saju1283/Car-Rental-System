<?php

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Authentication Routes
Auth::routes();

// Frontend Routes
Route::name('frontend.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    
    Route::resource('cars', CarController::class)->only(['index', 'show']);
    // Add this to your routes/web.php
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])
        ->name('frontend.rentals.show')
        ->middleware('auth');

    // Protected routes (require authentication)
    Route::middleware('auth')->group(function () {
        Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
        Route::get('/rentals/create/{car}', [RentalController::class, 'create'])->name('rentals.create');
        Route::post('/rentals/{car}', [RentalController::class, 'store'])->name('rentals.store');
        Route::post('/rentals/{rental}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');
    });
});

/*
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', AdminCarController::class);
    Route::resource('rentals', AdminRentalController::class)->except(['create', 'store']);
    Route::resource('customers', CustomerController::class)->only(['index', 'show', 'destroy']);
});
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/test-dashboard', [DashboardController::class, 'testDashboard'])->name('test-dashboard');

    Route::resource('cars', AdminCarController::class);
    Route::resource('rentals', AdminRentalController::class)->except(['create', 'store']);
    Route::resource('customers', CustomerController::class)->only(['index', 'show', 'destroy','edit', 'update',]);
});


// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Test email route (remove in production)
Route::get('/test-email', function() {
    $rental = App\Models\Rental::first();
    
    if (!$rental) {
        $rental = App\Models\Rental::factory()->create();
    }
    
    Mail::to('test@example.com')->send(new App\Mail\RentalConfirmation($rental));
    Mail::to('admin@example.com')->send(new App\Mail\AdminRentalNotification($rental));
    
    return 'Test emails sent!';
});