<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Fetch all counties ordered by name
     */
    public function getCounties()
    {
        $counties = County::orderBy('name', 'ASC')->get();
        return response()->json($counties);
    }

    /**
     * Handle user registration
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('user_photo')) {
            $photoPath = $request->file('user_photo')->store('user_photos', 'public');
        }

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'county_id' => $validated['county_id'],
            'user_photo' => $photoPath,
        ]);

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Handle user login
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        // Attempt login
        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $validated['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => [
                    'slug' => $user->role->slug ?? 'user'
                ],
                'county' => $user->county->name ?? null,
                'user_photo' => $user->user_photo ? asset('storage/' . $user->user_photo) : null,
            ],
            'abilities' => [
                'submit-data' => true,
                'view-analytics' => true,
            ]
        ]);
    }

    /**
     * Log out the current user (invalidate token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get authenticated user info
     */
    public function me(Request $request)
    {
        return response()->json($request->user()->load('county'));
    }
}
