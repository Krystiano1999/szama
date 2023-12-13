<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Użytkownik nie znaleziony'], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'phone_number' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Aktualizuj tylko te pola, które zostały zmienione
        $fieldsToUpdate = [];
        if ($request->has('email')) {
            $fieldsToUpdate['email'] = $request->input('email');
        }
        if ($request->has('phone_number')) {
            $fieldsToUpdate['phone_number'] = $request->input('phone_number');
        }
        if ($request->has('password')) {
            $fieldsToUpdate['password'] = Hash::make($request->input('password'));
        }
    
        $user->update($fieldsToUpdate);
    
        return response()->json(['message' => 'Dane użytkownika zaktualizowane pomyślnie']);
    }
}