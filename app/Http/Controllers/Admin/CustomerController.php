<?php

// app/Http/Controllers/Admin/CustomerController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->withCount('rentals')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        if ($customer->role !== 'customer') {
            abort(404);
        }

        $rentals = $customer->rentals()->with('car')->latest()->get();
        return view('admin.customers.show', compact('customer', 'rentals'));
    }

    public function destroy(User $customer)
    {
        if ($customer->role !== 'customer') {
            abort(404);
        }

        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }
}