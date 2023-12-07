<?php

namespace App\Http\Controllers;

use App\Models\Zamowienia;
use App\Models\SzczegolyZamowienia;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Pobieranie wszystkich zamówień wraz ze szczegółami
        return Zamowienia::with('szczegoly')->get();
    }

    public function store(Request $request)
    {
        // Walidacja danych
        $validatedData = $request->validate([
            'id_uzytkownika' => 'required|integer',
            'items' => 'required|array',
            'items.*.id_pozycji_menu' => 'required|integer',
            'items.*.ilosc' => 'required|integer',
            'items.*.cena' => 'required|numeric',
        ]);

        // Tworzenie nowego zamówienia
        $zamowienie = new Zamowienia();
        $zamowienie->ID_Uzytkownika = $validatedData['id_uzytkownika'];
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


    public function show($id)
    {
        // Pobieranie pojedynczego zamówienia
        $zamowienie = Zamowienia::with('szczegoly')->find($id);

        if (!$zamowienie) {
            return response()->json(['message' => 'Zamówienie nie znalezione'], 404);
        }

        return $zamowienie;
    }

    public function update(Request $request, $id)
    {
        // Aktualizacja zamówienia
        $zamowienie = Zamowienia::find($id);

        if (!$zamowienie) {
            return response()->json(['message' => 'Zamówienie nie znalezione'], 404);
        }

        $zamowienie->update($request->all());

        return response()->json($zamowienie, 200);
    }

    public function destroy($id)
    {
        // Usuwanie zamówienia
        $zamowienie = Zamowienia::find($id);

        if (!$zamowienie) {
            return response()->json(['message' => 'Zamówienie nie znalezione'], 404);
        }

        $zamowienie->delete();

        return response()->json(['message' => 'Zamówienie usunięte'], 200);
    }
}
