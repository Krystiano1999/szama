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
}
