<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracje;
use App\Models\Menu;
use App\Models\Kategorie;
use App\Services\NameService;
use Intervention\Image\ImageManager;


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
        // Walidacja danych
        $validatedData = $request->validate([
            'Nazwa_Pozycji' => 'required|max:255',
            'Cena' => 'required|numeric',
            'kategoria_id' => 'required|exists:kategorie,ID_Kategorii',
            'ID_Restauracji' => 'required|exists:restauracje,ID_Restauracji',
        ]);
    
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'Obrazek jest wymagany'], 422);
        }
    
        $imageFile = $request->file('image');
        
        // Pobieranie nazwy restauracji i posiłku
        $restaurant = Restauracje::find($validatedData['ID_Restauracji']);
        $mealName = $validatedData['Nazwa_Pozycji'];
        $category = Kategorie::find($validatedData['kategoria_id']);
    
        // Tworzenie opisu pozycji
        $opisPozycji = $category->Nazwa_Kategorii . ' ' . $mealName;
    
        // Normalizacja nazw
        $normalizedRestaurantName = $this->nameService->normalizeString($restaurant->Nazwa_Restauracji);
        $normalizedMealName = $this->nameService->normalizeString($mealName);
    
        // Definiowanie ścieżki zapisu obrazu
        $folderPath = "images/{$normalizedRestaurantName}";
        $fileName = "{$normalizedMealName}.png";
        $fullPath = "{$folderPath}/{$fileName}";
    
        // Tworzenie folderu, jeśli nie istnieje
        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0777, true);
        }

        if ($imageFile->getSize() > (1.8 * 1024 * 1024)) {
            return response()->json(['error' => 'Rozmiar obrazka musi być mniejszy niż 1.8MB'], 422);
        }
        
        // Przetwarzanie i zapis obrazu w formacie PNG
        $manager = ImageManager::gd();
        $image = $manager->read($imageFile);
        $image = $image->scale(width: 300);
        $image = $image->toPng()->save($fullPath);
    
        // Tworzenie wpisu w bazie danych
        $menuItem = new Menu();
        $menuItem->Nazwa_Pozycji = $validatedData['Nazwa_Pozycji'];
        $menuItem->Cena = $validatedData['Cena'];
        $menuItem->kategoria_id = $validatedData['kategoria_id'];
        $menuItem->ID_Restauracji = $validatedData['ID_Restauracji'];
        $menuItem->Opis_Pozycji = $opisPozycji; 
        $menuItem->save();
    
        return response()->json([
            'message' => 'Pozycja menu została dodana',
            'menuItem' => $menuItem,
            'imagePath' => $fullPath
        ]);
    }

    public function deleteMenuItem($itemId)
    {
        $menuItem = Menu::where('ID_Pozycji_Menu', $itemId)->first();
    
        if (!$menuItem) {
            return response()->json(['message' => 'Pozycja menu nie została znaleziona'], 404);
        }
    
        try {
            $menuItem->delete();
            return response()->json(['message' => 'Pozycja menu została usunięta']);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return response()->json(['message' => 'Nie można usunąć pozycji menu, ponieważ jest ona powiązana z istniejącymi zamówieniami'], 409);
            }
            return response()->json(['message' => 'Wystąpił błąd podczas usuwania pozycji menu'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Wystąpił nieoczekiwany błąd'], 500);
        }
    }
    

    
}