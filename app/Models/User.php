<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rental;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'address', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin'; // or $this->is_admin === true if using boolean
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}