<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function getCounties (){

        $counties = County::orderBy('name', 'ASC')->get();


        return response()->json($counties);
    }
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
            'county_id' => 'required|exists:counties,id',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle the uploaded photo
        $photoPath = null;
        if ($request->hasFile('user_photo')) {
            $photoPath = $request->file('user_photo')->store('user_photos', 'public');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'county_id' => $request->county_id,
            'user_photo' => $photoPath,
        ]);

        // Generate an access token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        // Validate incoming login request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Attempt to authenticate
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,  // <<------ Changed from 'access_token' to 'token'
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // Add 'role' manually (if you have a role system)
                'role' => [
                    'slug' => $user->role->slug ?? 'user'
                ],
                'county' => $user->county->name ?? null,
                'user_photo' => $user->user_photo ? asset('storage/'.$user->user_photo) : null,
            ],
            'abilities' => [
                'submit-data' => true,
                'view-analytics' => true,
            ]
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function me(Request $request)
    {
        // Return user along with their county
        return response()->json($request->user()->load('county'));
    }
}
