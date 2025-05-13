<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@carrental.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '1234567890',
            'address' => '123 Admin Street'
        ]);

        // Create a test customer
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone_number' => '9876543210',
            'address' => '456 Customer Avenue'
        ]);
    }
}