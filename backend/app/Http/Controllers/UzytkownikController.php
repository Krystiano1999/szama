<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UzytkownikController extends Controller
{
    public function dodajUzytkownikaForm()
    {
        return view('dodaj_uzytkownika');
    }

    public function dodajUzytkownika(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect('/')->with('success', 'Użytkownik dodany pomyślnie');
    }
}
