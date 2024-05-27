<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            ['name' => 'Ankara', 'latitude' => 39.92077, 'longitude' => 32.85411, 'color' => '#FF5733'],
            ['name' => 'İstanbul', 'latitude' => 41.00485, 'longitude' => 28.68252, 'color' => '#33C4FF'],
            ['name' => 'Yozgat', 'latitude' => 39.81521, 'longitude' => 34.77095, 'color' => '#8E44AD'],
            ['name' => 'Edirne', 'latitude' => 41.66886, 'longitude' => 26.53212, 'color' => '#2ECC71'],
            ['name' => 'Bingöl', 'latitude' => 38.88318, 'longitude' => 40.48024, 'color' => '#F39C12'],
            ['name' => 'Hakkari', 'latitude' => 37.57427, 'longitude' => 43.71419, 'color' => '#3498DB']
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
