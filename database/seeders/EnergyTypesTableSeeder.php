<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyType;

class EnergyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            ['name' => 'Solar', 'color' => '#f39c12'],        // Orange-yellow
            ['name' => 'Wind', 'color' => '#3498db'],         // Sky blue
            ['name' => 'Hydro', 'color' => '#1abc9c'],        // Aqua
            ['name' => 'Biomass', 'color' => '#27ae60'],      // Green
            ['name' => 'Geothermal', 'color' => '#8e44ad'],   // Purple
            ['name' => 'Tidal', 'color' => '#2980b9'],        // Ocean blue
            ['name' => 'Nuclear', 'color' => '#e74c3c'],      // Red
            ['name' => 'Natural Gas', 'color' => '#95a5a6'],  // Gray
            ['name' => 'Coal', 'color' => '#2c3e50'],         // Dark gray
            ['name' => 'Diesel', 'color' => '#7f8c8d'],       // Slate gray
            ['name' => 'Battery Storage', 'color' => '#9b59b6'], // Lavender
            ['name' => 'Hybrid Systems', 'color' => '#e67e22'],  // Orange
        ];

        EnergyType::insert($types);
    }
}
