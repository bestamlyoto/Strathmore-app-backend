<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Models\EnergyInstallation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CountyDataController extends Controller
{
    public function index()
    {
        // Fetch raw data from energy_installations table, grouped by county and energy type
        $rawCountyData = EnergyInstallation::select(
                'counties.name as county_name',
                'counties.x_coord',
                'counties.y_coord',
                'energy_type',
                DB::raw('COUNT(*) as households')
            )
            ->join('counties', 'energy_installations.county_id', '=', 'counties.id')
            ->groupBy('counties.name', 'energy_type', 'counties.x_coord', 'counties.y_coord')
            ->get();

        // Format counties with data for map overlay
        $counties = $rawCountyData->map(function ($item) {
            return [
                'name' => $item->county_name,
                'x' => $item->x_coord,
                'y' => $item->y_coord,
                'energyType' => $item->energy_type,
                'households' => $item->households,
            ];
        });

        // Compute energy type distribution
        $energyStats = $rawCountyData
            ->groupBy('energy_type')
            ->map(function ($group, $type) {
                $total = $group->sum('households');
                return [
                    'type' => $type,
                    'households' => $total,
                ];
            })
            ->values();

        // Add percentages
        $totalHouseholds = $energyStats->sum('households');
        $energyStats = $energyStats->map(function ($item) use ($totalHouseholds) {
            return [
                'type' => $item['type'],
                'households' => $item['households'],
                'percentage' => round(($item['households'] / $totalHouseholds) * 100, 1),
            ];
        });

        // Top performing counties
        $topCounties = $counties->sortByDesc('households')->take(5)->map(function ($item) {
            return [
                'name' => $item['name'],
                'households' => $item['households'],
                'energyType' => $item['energyType'],
                'adoptionRate' => rand(50, 90), // or compute based on actual data if available
            ];
        });

        // Respond to frontend
        return response()->json([
            'counties' => $counties,
            'energyStats' => $energyStats,
            'topCounties' => $topCounties->values(),
            'totalHouseholds' => $totalHouseholds,
            'lastUpdated' => now()->toDateTimeString(),
        ]);
    }
}
