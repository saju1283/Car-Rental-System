<?php

// app/Models/Car.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand', 'model', 'year', 'car_type', 
        'daily_rent_price', 'availability', 'image'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function isAvailableBetween($startDate, $endDate)
    {
        return !$this->rentals()
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function($query) use ($startDate, $endDate) {
                          $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                      });
            })
            ->whereIn('status', ['pending', 'ongoing'])
            ->exists();
    }

    // app/Models/Rental.php
    public function car()
    {
        return $this->belongsTo(Car::class)->withTrashed();
    }
}
