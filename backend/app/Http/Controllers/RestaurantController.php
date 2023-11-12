<?php
// app/Http/Controllers/RestaurantController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracje; // Dodaj odpowiednią ścieżkę do modelu Restauracje

class RestaurantController extends Controller
{
    public function getRestaurantsByCity(Request $request)
    {
        $cityName = $request->input('miasto'); // Pobierz nazwę miasta z zapytania

        // Tutaj możesz użyć modelu, aby pobrać restauracje z danego miasta
        $restaurants = Restauracje::where('Miasto', $cityName)->get();

        return response()->json(['restaurants' => $restaurants]);
    }
}
