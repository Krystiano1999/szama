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
        $cityName = $request->input('miasto'); // Pobierz nazwę miasta z zapytania

        // Tutaj możesz użyć modelu, aby pobrać restauracje z danego miasta
        $restaurants = Restauracje::where('Miasto', $cityName)->get();

        return response()->json(['restaurants' => $restaurants]);
    }
//Zwraca ona wszystkie restauracje oraz ich dokładny adres
    public function getRestaurants()
{
    // Pobierz wszystkie restauracje bez filtra miasta
    $restaurants = Restauracje::all();

    // Iteruj przez kolekcję i pobierz wybrane pola
    $restaurantData = $restaurants->map(function ($restaurant) {
        return [
            'ID_Restauracji' => $restaurant->ID_Restauracji,
            'Nazwa_Restauracji' => $restaurant->Nazwa_Restauracji,
            'Wojewodztwo' => $restaurant->Wojewodztwo,
            'Miasto' => $restaurant->Miasto,
            'Adres' => $restaurant->Adres,
        ];
    });

    return response()->json(['restaurants' => $restaurantData]);
}
    
}
