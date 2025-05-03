<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\County;

class CountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
County::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $counties = [
            ['id' => 1, 'name' => 'Mombasa', 'latitude' => -4.0435, 'longitude' => 39.6682],
            ['id' => 2, 'name' => 'Kwale', 'latitude' => -4.1731, 'longitude' => 39.4521],
            ['id' => 3, 'name' => 'Kilifi', 'latitude' => -3.5105, 'longitude' => 39.9093],
            ['id' => 4, 'name' => 'Tana River', 'latitude' => -1.2856, 'longitude' => 40.2021],
            ['id' => 5, 'name' => 'Lamu', 'latitude' => -2.2717, 'longitude' => 40.9020],
            ['id' => 6, 'name' => 'Taita Taveta', 'latitude' => -3.3161, 'longitude' => 38.4846],
            ['id' => 7, 'name' => 'Garissa', 'latitude' => -0.4532, 'longitude' => 39.6460],
            ['id' => 8, 'name' => 'Wajir', 'latitude' => 1.75, 'longitude' => 40.05],
            ['id' => 9, 'name' => 'Mandera', 'latitude' => 3.9376, 'longitude' => 41.8569],
            ['id' => 10, 'name' => 'Marsabit', 'latitude' => 2.3346, 'longitude' => 37.9896],
            ['id' => 11, 'name' => 'Isiolo', 'latitude' => 0.3546, 'longitude' => 37.5822],
            ['id' => 12, 'name' => 'Meru', 'latitude' => 0.0471, 'longitude' => 37.6498],
            ['id' => 13, 'name' => 'Tharaka Nithi', 'latitude' => -0.3031, 'longitude' => 38.1875],
            ['id' => 14, 'name' => 'Embu', 'latitude' => -0.5389, 'longitude' => 37.4510],
            ['id' => 15, 'name' => 'Kitui', 'latitude' => -1.3664, 'longitude' => 38.0106],
            ['id' => 16, 'name' => 'Machakos', 'latitude' => -1.5177, 'longitude' => 37.2634],
            ['id' => 17, 'name' => 'Makueni', 'latitude' => -1.8032, 'longitude' => 37.6186],
            ['id' => 18, 'name' => 'Nyandarua', 'latitude' => -0.1833, 'longitude' => 36.5],
            ['id' => 19, 'name' => 'Nyeri', 'latitude' => -0.4167, 'longitude' => 36.95],
            ['id' => 20, 'name' => 'Kirinyaga', 'latitude' => -0.6601, 'longitude' => 37.3827],
            ['id' => 21, 'name' => 'Murang\'a', 'latitude' => -0.7833, 'longitude' => 37.0333],
            ['id' => 22, 'name' => 'Kiambu', 'latitude' => -1.1667, 'longitude' => 36.8333],
            ['id' => 23, 'name' => 'Turkana', 'latitude' => 3.3120, 'longitude' => 35.5658],
            ['id' => 24, 'name' => 'West Pokot', 'latitude' => 1.2381, 'longitude' => 35.1200],
            ['id' => 25, 'name' => 'Samburu', 'latitude' => 0.6352, 'longitude' => 36.7065],
            ['id' => 26, 'name' => 'Trans Nzoia', 'latitude' => 1.0469, 'longitude' => 35.1666],
            ['id' => 27, 'name' => 'Uasin Gishu', 'latitude' => 0.4532, 'longitude' => 35.2698],
            ['id' => 28, 'name' => 'Elgeyo Marakwet', 'latitude' => 1.1167, 'longitude' => 35.4667],
            ['id' => 29, 'name' => 'Nandi', 'latitude' => 0.1167, 'longitude' => 35.2],
            ['id' => 30, 'name' => 'Baringo', 'latitude' => 0.4646, 'longitude' => 36.0917],
            ['id' => 31, 'name' => 'Laikipia', 'latitude' => 0.4167, 'longitude' => 36.6333],
            ['id' => 32, 'name' => 'Nakuru', 'latitude' => -0.3031, 'longitude' => 36.0800],
            ['id' => 33, 'name' => 'Narok', 'latitude' => -1.0800, 'longitude' => 35.8600],
            ['id' => 34, 'name' => 'Kajiado', 'latitude' => -1.8511, 'longitude' => 36.7768],
            ['id' => 35, 'name' => 'Kericho', 'latitude' => -0.3670, 'longitude' => 35.2830],
            ['id' => 36, 'name' => 'Bomet', 'latitude' => -0.7820, 'longitude' => 35.3020],
            ['id' => 37, 'name' => 'Kakamega', 'latitude' => 0.2827, 'longitude' => 34.7519],
            ['id' => 38, 'name' => 'Vihiga', 'latitude' => 0.0697, 'longitude' => 34.7085],
            ['id' => 39, 'name' => 'Bungoma', 'latitude' => 0.5635, 'longitude' => 34.5584],
            ['id' => 40, 'name' => 'Busia', 'latitude' => 0.4608, 'longitude' => 34.1118],
            ['id' => 41, 'name' => 'Siaya', 'latitude' => 0.0623, 'longitude' => 34.2881],
            ['id' => 42, 'name' => 'Kisumu', 'latitude' => -0.0917, 'longitude' => 34.7679],
            ['id' => 43, 'name' => 'Homa Bay', 'latitude' => -0.5273, 'longitude' => 34.4570],
            ['id' => 44, 'name' => 'Migori', 'latitude' => -1.0634, 'longitude' => 34.4731],
            ['id' => 45, 'name' => 'Kisii', 'latitude' => -0.6817, 'longitude' => 34.7667],
            ['id' => 46, 'name' => 'Nyamira', 'latitude' => -0.5696, 'longitude' => 34.9341],
            ['id' => 47, 'name' => 'Nairobi', 'latitude' => -1.286389, 'longitude' => 36.817223],
        ];

        County::upsert($counties, ['id']);
    }
}
