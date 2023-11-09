<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UzytkownikController extends Controller
{
    public function dodajUzytkownikaForm()
    {
        return view('dodaj_uzytkownika');
    }

    public function dodajUzytkownika(Request $request)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
    
        // Tworzenie nowego użytkownika
        $uzytkownik = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ]);
    
        if ($uzytkownik) {
            return redirect('/')->with('success', 'Użytkownik dodany pomyślnie');
        } else {
            return redirect()->back()->withInput()->with('error', 'Wystąpił błąd podczas dodawania użytkownika');
        }
    }
    


    public function pokazFormularzLogowania()
    {
        return view('login');
    }
    public function zalogujUzytkownika(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return view('logged_in', ['user' => $user]);
        }

        return view('login')->with('error', 'Błędne dane logowania');
    }
}
