<?php

namespace App\Http\Controllers;

use App\Models\Zamowienia;
use App\Models\SzczegolyZamowienia;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $zamowienia = Zamowienia::with(['szczegoly', 'szczegoly.menu'])->get();
        return response()->json($zamowienia);
    }

    public function store(Request $request)
    {
        // Walidacja danych
        $validatedData = $request->validate([
            'id_uzytkownika' => 'required|integer',
            'id_restauracji' => 'required|integer',
            'items' => 'required|array',
            'items.*.id_pozycji_menu' => 'required|integer',
            'items.*.ilosc' => 'required|integer',
            'items.*.cena' => 'required|numeric',
        ]);

        // Tworzenie nowego zamówienia
        $zamowienie = new Zamowienia();
        $zamowienie->ID_Uzytkownika = $validatedData['id_uzytkownika'];
        $zamowienie->ID_Restauracji = $validatedData['id_restauracji'];
        $zamowienie->Status_Zamowienia = 'Nowe'; // Domyślny status
        $zamowienie->Cena = array_sum(array_column($validatedData['items'], 'cena'));
        $zamowienie->save();

        // Dodanie szczegółów zamówienia
        foreach ($validatedData['items'] as $item) {
            $szczegolZamowienia = new SzczegolyZamowienia();
            $szczegolZamowienia->zamowienia_id = $zamowienie->ID_Zamowienia;
            $szczegolZamowienia->ID_Pozycji_Menu = $item['id_pozycji_menu'];
            $szczegolZamowienia->Ilosc = $item['ilosc'];
            $szczegolZamowienia->Cena = $item['cena'];
            $szczegolZamowienia->save();
        }

        return response()->json($zamowienie->load('szczegoly'), 201);
    }

    public function getOrdersByRestaurant($restaurantId)
    {
        $zamowienia = Zamowienia::with(['szczegoly', 'szczegoly.menu'])
            ->where('ID_Restauracji', $restaurantId)
            ->get();
        return response()->json($zamowienia);
    }

    public function updateStatus(Request $request, $orderId)
    {
        $zamowienie = Zamowienia::findOrFail($orderId);
        $zamowienie->Status_Zamowienia = $request->newStatus;
        $zamowienie->save();

        return response()->json($zamowienie);
    }

    public function getOrdersByUser($userId)
    {
        $zamowienia = Zamowienia::with(['szczegoly', 'szczegoly.menu'])
            ->where('ID_Uzytkownika', $userId)
            ->get();
        return response()->json($zamowienia);
    }

}