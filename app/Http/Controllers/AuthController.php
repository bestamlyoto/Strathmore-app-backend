<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Implement login logic here
        return response()->json(['message' => 'Login route hit']);
    }

    public function register(Request $request)
    {
        // Implement registration logic here
        return response()->json(['message' => 'Register route hit']);
    }
}
