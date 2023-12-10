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

    public function addMenuItem(Request $request)
    {
        $data = $request->validate([
            'Nazwa_Pozycji' => 'required|max:255',
            'Cena' => 'required|numeric',
            'kategoria_id' => 'required|exists:kategorie,ID_Kategorii',
            'ID_Restauracji' => 'required|exists:restauracje,ID_Restauracji',
        ]);
    
        // Pobierz nazwę kategorii
        $categoryName = Kategorie::where('ID_Kategorii', $data['kategoria_id'])->first()->Nazwa_Kategorii;
    
        // Utwórz opis pozycji
        $opisPozycji = $categoryName . ' ' . $data['Nazwa_Pozycji'];
    
        // Dodaj opis do danych
        $data['Opis_Pozycji'] = $opisPozycji;
    
        $menuItem = Menu::create($data);

        if ($request->hasFile('image')) {
            $filename = $this->saveImage($request->file('image'), $data['Nazwa_Pozycji']);
            $menuItem->update(['imageUrl' => $filename]);
        }

        return response()->json(['message' => 'Pozycja menu została dodana', 'menuItem' => $menuItem]);
    }

    protected function saveImage($image, $itemName)
    {
        $normalizedName = $this->nameService->makeImgName($itemName);
        $filename = $normalizedName . '.' . $image->getClientOriginalExtension();
        $path = public_path('images/' . $normalizedName);
        $image->move($path, $filename);
        return '/images/' . $normalizedName . '/' . $filename;
    }

    public function deleteMenuItem($itemId)
    {
        $menuItem = Menu::where('ID_Pozycji_Menu', $itemId)->first();

        if (!$menuItem) {
            return response()->json(['message' => 'Pozycja menu nie została znaleziona'], 404);
        }
    
        $menuItem->delete();
    
        return response()->json(['message' => 'Pozycja menu została usunięta']);
    }

    
}