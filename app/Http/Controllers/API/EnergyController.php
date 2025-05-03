<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EnergySubmission;
use App\Models\EnergyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnergyController extends Controller
{
    public function getEnergyTypes()
    {
        return response()->json(EnergyType::all());
    }

    public function submitEnergyData(Request $request)
    {
        $validated = $request->validate([
            'county_id' => 'required|exists:counties,id',
            'energy_type_id' => 'required|exists:energy_types,id',
            'house_type' => 'required|in:Apartment,Bungalow,Maisonette,Standalone House,Eco-Dome',
            'energy_capacity' => 'nullable|numeric',
            'installation_date' => 'nullable|date',
            'is_primary' => 'boolean',
        ]);

        $submission = EnergySubmission::create([
            'user_id' => Auth::id(),
            ...$validated
        ]);

        return response()->json($submission->load(['county', 'energyType']), 201);
    }

    public function getUserSubmissions()
{
    return response()->json(
        EnergySubmission::where('user_id', Auth::id())
            ->with(['county', 'energyType'])
            ->get()
    );
}
}