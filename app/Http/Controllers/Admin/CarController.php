<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    public function index()
    {
        /*
        if (Gate::denies('is-customer')) 
        {
            abort(403);
        }
        */
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {    
        /*
        if (Gate::denies('is-customer')) 
        {
            abort(403);
        }
        */
        return view('admin.cars.create', [
        'carTypes' => ['SUV', 'Sedan', 'Hatchback', 'Coupe', 'Convertible', 'Wagon']
    ]);
    
        //return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) 
        {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/car_images'), $imageName);
            $validated['image'] = $imageName;
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully!');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) 
        {
            // Delete old image
            if ($car->image && file_exists(public_path('images/car_images/' . $car->image))) {
                unlink(public_path('images/car_images/' . $car->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/car_images'), $imageName);
            $validated['image'] = $imageName;
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }
}