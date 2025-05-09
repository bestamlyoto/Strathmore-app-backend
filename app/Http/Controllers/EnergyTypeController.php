<?php

namespace App\Http\Controllers;

use App\Models\EnergyType;
use Illuminate\Http\JsonResponse;

class EnergyTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(EnergyType::select('id', 'name')->get());
    }
}
