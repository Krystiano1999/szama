<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantRegistrationModel;

class RestaurantRegistrationController extends Controller
{
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
}
