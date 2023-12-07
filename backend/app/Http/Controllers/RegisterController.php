<?php
// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Zarejestruj nowego użytkownika.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Walidacja danych wejściowych
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'required|string|min:6',
            'user_type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Sprawdź unikalność username
        if (User::where('username', $request->input('username'))->exists()) {
            return response()->json(['error' => ['username' => ['Nazwa użytkownika jest już zajęta.']]], 422);
        }

        // Sprawdź unikalność email
        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json(['error' => ['email' => ['Adres email jest już zajęty.']]], 422);
        }

        // Utwórz nowego użytkownika
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password')),
            'user_type' => $request->input('user_type'), 
        ]);

        return response()->json(['message' => 'Użytkownik zarejestrowany pomyślnie']);
    }
}
