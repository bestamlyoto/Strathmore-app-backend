<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\EnergySubmission;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getCountyData()
    {
        $counties = County::withCount(['energySubmissions as total_installations'])
            ->with(['energySubmissions' => function($query) {
                $query->selectRaw('county_id, energy_type_id, count(*) as count')
                    ->groupBy('county_id', 'energy_type_id')
                    ->with('energyType');
            }])
            ->get();

        return response()->json($counties);
    }

    public function getCountyStats($countyId)
    {
        $county = County::with(['energySubmissions' => function($query) {
            $query->with('energyType')
                ->selectRaw('county_id, energy_type_id, count(*) as count,
                            avg(energy_capacity) as avg_capacity')
                ->groupBy('county_id', 'energy_type_id');
        }])->findOrFail($countyId);

        return response()->json($county);
    }
}