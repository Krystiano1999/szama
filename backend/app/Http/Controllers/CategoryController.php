<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategorie; 

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Kategorie::all(['ID_Kategorii as id', 'Nazwa_Kategorii as name']);
        return response()->json($categories);
    }
}
