<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing images if any
        Storage::disk('public')->deleteDirectory('car_images');
        
        // Create directory if it doesn't exist
        Storage::disk('public')->makeDirectory('car_images');

        $cars = [
            [
                'name' => 'Toyota Camry',
                'brand' => 'Toyota',
                'model' => 'Camry',
                'year' => 2022,
                'car_type' => 'Sedan',
                'daily_rent_price' => 65.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.toyota.com/imgix/responsive/images/mlp/colorizer/2022/camry/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
            [
                'name' => 'Honda CR-V',
                'brand' => 'Honda',
                'model' => 'CR-V',
                'year' => 2021,
                'car_type' => 'SUV',
                'daily_rent_price' => 75.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.honda.com/imgix/responsive/images/mlp/colorizer/2021/cr-v/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
            [
                'name' => 'Ford Mustang',
                'brand' => 'Ford',
                'model' => 'Mustang',
                'year' => 2023,
                'car_type' => 'Sports Car',
                'daily_rent_price' => 120.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.ford.com/imgix/responsive/images/mlp/colorizer/2023/mustang/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
            [
                'name' => 'Chevrolet Tahoe',
                'brand' => 'Chevrolet',
                'model' => 'Tahoe',
                'year' => 2022,
                'car_type' => 'SUV',
                'daily_rent_price' => 95.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.chevrolet.com/imgix/responsive/images/mlp/colorizer/2022/tahoe/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
            [
                'name' => 'BMW 3 Series',
                'brand' => 'BMW',
                'model' => '3 Series',
                'year' => 2023,
                'car_type' => 'Luxury Sedan',
                'daily_rent_price' => 110.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.bmw.com/imgix/responsive/images/mlp/colorizer/2023/3-series/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
            [
                'name' => 'Tesla Model 3',
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'year' => 2023,
                'car_type' => 'Electric',
                'daily_rent_price' => 130.00,
                'availability' => true,
                'image' => $this->storeImage('https://www.tesla.com/imgix/responsive/images/mlp/colorizer/2023/model-3/1H0/1.png?w=800&h=450&auto=compress%2Cformat&fit=crop&bg=0FFF&q=90')
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }

    private function storeImage(string $url): string
    {
        try {
            $contents = file_get_contents($url);
            $name = basename($url);
            $path = 'car_images/' . $name;
            Storage::disk('public')->put($path, $contents);
            return $path;
        } catch (\Exception $e) {
            return ''; // Return empty string if image download fails
        }
    }
}