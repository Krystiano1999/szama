<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracje;
use App\Models\Menu;
use App\Models\Kategorie;
use App\Services\NameService;

class RestaurantMenuController extends Controller
{
    protected $nameService;

    public function __construct(NameService $nameService)
    {
        $this->nameService = $nameService;
    }

    public function getCategoriesAndMenu($restaurantId)
    {
        $restaurant = Restauracje::find($restaurantId);

        if (!$restaurant) {
            return response()->json(['message' => 'Restauracja nie została znaleziona'], 404);
        }

        // Pobierz kategorie, które mają przynajmniej jedną pozycję w menu
        $categories = Kategorie::whereHas('menu', function ($query) use ($restaurantId) {
            $query->where('ID_Restauracji', $restaurantId);
        })->with(['menu' => function ($query) use ($restaurantId) {
            $query->where('ID_Restauracji', $restaurantId);
        }])->get();

        // Struktura danych zgodna z Vue
        $formattedMenu = $categories->mapWithKeys(function ($category) {
            return [$category->Nazwa_Kategorii => $category->menu->map(function ($item) {

                $imageUrl = $this->nameService->makeImgName($item->Nazwa_Pozycji);

                return [
                    'id' => $item->ID_Pozycji_Menu,
                    'name' => $item->Nazwa_Pozycji,
                    'price' => $item->Cena,
                    'imageUrl' => $imageUrl
                ];
            })];
        });

        return response()->json([
            'restaurant' => [
                'id' => $restaurant->ID_Restauracji,
                'name' => $restaurant->Nazwa_Restauracji,
                'city' => $restaurant->Miasto,
                'menu' => $formattedMenu
            ]
        ]);
    }

}
