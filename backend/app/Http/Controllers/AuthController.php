<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        return $this->login($request, 1); // 1 to typ użytkownika dla admina
    }

    public function loginSuperAdmin(Request $request)
    {
        return $this->login($request, 2); // 2 to typ użytkownika dla superadmina
    }

    public function login(Request $request, $userType = null)
    {
        $credentials = $request->only('username', 'password');

        if ($userType !== null) {
            // Dodajemy warunek user_type tylko jeśli jest podany
            $credentials['user_type'] = $userType;
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Pobierz zalogowanego użytkownika

            // Sprawdź, czy typ użytkownika zgadza się z oczekiwanym, jeśli podano $userType
            if ($userType !== null && $user->user_type != $userType) {
                return response()->json(['error' => 'Nieprawidłowy typ użytkownika'], 401);
            }

            // Tworzenie tokena Sanctum dla zalogowanego użytkownika
            $token = $user->createToken('API Token')->plainTextToken;

            // Zwróć id i username użytkownika wraz z tokenem
            return response()->json([
                'message' => 'Użytkownik zalogowany',
                'user_id' => $user->id,
                'username' => $user->username,
                'token' => $token, 
                'email' => $user->email, 
                'phone_number' => $user->phone_number, 
                'user_type' => $user->user_type, 
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