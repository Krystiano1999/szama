<?php
// app/Http/Controllers/RestaurantController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracje; 

//Zwraca ona wszystkie restauracje z danego miasta
class RestaurantController extends Controller
{
    public function getRestaurantsByCity(Request $request)
    {
        $cityName = $request->input('miasto');
        $restaurants = Restauracje::where('Miasto', $cityName)->get()->map(function ($restaurant) {
            return [
                'id' => $restaurant->ID_Restauracji,
                'name' => $restaurant->Nazwa_Restauracji,
                'city' => $restaurant->Miasto
            ];
        });

        return response()->json(['restaurants' => $restaurants]);
    }

    public function getAllRestaurants()
    {
        $restaurants = Restauracje::with('user') 
                        ->get()
                        ->sortBy('Miasto')
                        ->map(function ($restaurant) {
                            return [
                                'id' => $restaurant->ID_Restauracji,
                                'name' => $restaurant->Nazwa_Restauracji,
                                'owner' => $restaurant->user->username,
                                'city' => $restaurant->Miasto,
                                'address' => $restaurant->Adres,
                                'description' => $restaurant->Opis
                            ];
                        });

        return response()->json(['restaurants' => $restaurants]);
    }

    public function deleteRestaurant($id)
    {
        $restaurant = Restauracje::find($id);
        if ($restaurant) {
            $restaurant->delete();
            return response()->json(['message' => 'Restauracja została usunięta.']);
        } else {
            return response()->json(['message' => 'Nie znaleziono restauracji.'], 404);
        }
    }

    public function getRestaurantData($userId)
    {
        $restaurant = Restauracje::where('user_id', $userId)->first();
        if ($restaurant) {
            return response()->json(['restaurant' => $restaurant]);
        } else {
            return response()->json(['message' => 'Restauracja nie znaleziona'], 404);
        }
    }

    public function updateRestaurantData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'region' => 'required',
            'city' => 'required',
            'address' => 'required',
            'description' => 'required',
            'id' => 'required|exists:restauracje,ID_Restauracji' // Uprawdź, czy ID istnieje
        ]);
    
        $restaurant = Restauracje::find($validatedData['id']);
        if ($restaurant) {
            $restaurant->Nazwa_Restauracji = $validatedData['name'];
            $restaurant->Wojewodztwo = $validatedData['region'];
            $restaurant->Miasto = $validatedData['city'];
            $restaurant->Adres = $validatedData['address'];
            $restaurant->Opis = $validatedData['description'];
            $restaurant->save(); // Zapisz zmiany
    
            return response()->json(['message' => 'Dane restauracji zaktualizowane']);
        } else {
            return response()->json(['message' => 'Restauracja nie znaleziona'], 404);
        }
    }
    

}
