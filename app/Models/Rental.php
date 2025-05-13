<?php

// app/Models/Rental.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Rental extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'car_id', 'start_date', 'end_date', 'total_cost', 'status'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // app/Models/Rental.php
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
    ];

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $rentals = $user->rentals()
            ->rentals()
            ->with('car') // withTrashed is already handled in the relationship
            ->latest()
            ->paginate(10);

        return view('frontend.rentals.index', compact('rentals'));
    }
}
