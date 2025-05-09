<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\JsonResponse;

class CountyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(County::select('id', 'name')->get());
    }
}