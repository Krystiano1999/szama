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
        $restaurants = Restauracje::with('user') // Załaduj powiązane dane użytkownika
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

}
