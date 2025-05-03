<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EnergyType;

class EnergyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/EnergyTypesTableSeeder.php
public function run()
{
    $types = [
        ['name' => 'Solar', 'color' => '#f39c12'],
        ['name' => 'Wind', 'color' => '#3498db'],
        // Other types...
    ];

    EnergyType::insert($types);
}
}
