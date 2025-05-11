<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // set to false if you want to restrict
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'county_id' => 'required|exists:counties,id',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
