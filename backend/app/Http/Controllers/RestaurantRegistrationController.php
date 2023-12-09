<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantRegistrationModel;
use App\Models\Restauracje;
use App\Models\User;

class RestaurantRegistrationController extends Controller
{
    public function index()
    {
        $registrations = RestaurantRegistrationModel::all();
        return response()->json($registrations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'owner_name' => 'required|string|max:255',
            'restaurant_name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:20'
        ]);

        $registration = RestaurantRegistrationModel::create($validatedData);

        return response()->json(['message' => 'Rejestracja restauracji zakończona sukcesem.', 'data' => $registration], 201);
    }

    public function destroy($id)
    {
        $registration = RestaurantRegistrationModel::find($id);
        if (!$registration) {
            return response()->json(['message' => 'Zgłoszenie nie znaleziono.'], 404);
        }

        $registration->delete();
        return response()->json(['message' => 'Zgłoszenie zostało odrzucone i usunięte.'], 200);
    }

    public function acceptRegistration(Request $request, $id)
    {
        $registration = RestaurantRegistrationModel::find($id);

        if (!$registration) {
            return response()->json(['message' => 'Zgłoszenie nie znaleziono.'], 404);
        }

        if (User::where('email', $registration->email)->exists()) {
            return response()->json(['message' => 'Adres email już istnieje w bazie.'], 409);
        }

        // Tworzenie użytkownika
        $username = preg_replace('/\s+/', '', $registration->owner_name);
        $username = Str::slug($username) . rand(1000, 9999);
        $password = Str::random(10);
        $user = User::create([
            'username' => $username,
            'email' => $registration->email,
            'phone_number' => $registration->phone_number,
            'address' => $registration->city,
            'password' => Hash::make($password),
            'user_type' => 1,
        ]);

        // Tworzenie restauracji
        $restaurant = Restauracje::create([
            'Nazwa_Restauracji' => $registration->restaurant_name,
            'Wojewodztwo' => $registration->province,
            'Miasto' => $registration->city,
            'Adres' => $registration->address,
            'Opis' => $registration->description,
        ]);

        // Wysyłanie e-maila z danymi logowania
        Mail::send('emails.registrationAccepted', ['username' => $username, 'password' => $password], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Akceptacja rejestracji restauracji');
        });

        $registration->delete(); // Usunięcie zgłoszenia

        return response()->json(['message' => 'Zgłoszenie zostało zaakceptowane. Dane logowania wysłane na email.']);
    }
}
