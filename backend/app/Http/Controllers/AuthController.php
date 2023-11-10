<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Pobierz zalogowanego użytkownika

            // Zwróć id i username użytkownika
            return response()->json([
                'message' => 'Użytkownik zalogowany',
                'user_id' => $user->id,
                'username' => $user->username,
            ]);
        } else {
            return response()->json(['error' => 'Nieprawidłowe dane logowania'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Użytkownik wylogowany']);
    }
}
