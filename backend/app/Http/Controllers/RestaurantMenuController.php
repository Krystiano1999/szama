<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracje;
use App\Models\Menu;
use App\Models\Kategorie;

class RestaurantMenuController extends Controller
{
    public function getCategoriesAndMenu($restaurantId)
    {
        // Pobierz restaurację na podstawie ID
        $restaurant = Restauracje::find($restaurantId);

        if (!$restaurant) {
            return response()->json(['message' => 'Restauracja nie została znaleziona'], 404);
        }

        // Pobierz kategorie dla danej restauracji
        $categories = Kategorie::join('powiazania_kategorie_menu', 'kategorie.ID_Kategorii', '=', 'powiazania_kategorie_menu.ID_Kategorii')
            ->join('menu', 'powiazania_kategorie_menu.ID_Pozycji_Menu', '=', 'menu.ID_Pozycji_Menu')
            ->where('menu.ID_Restauracji', $restaurantId)
            ->select('kategorie.*')
            ->distinct()
            ->get();

        // Pobierz menu dla danej restauracji
        $menu = Menu::where('ID_Restauracji', $restaurantId)->get();

        return response()->json([
            'categories' => $categories,
            'menu' => $menu,
        ]);
    }
}
