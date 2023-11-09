<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UzytkownikController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dodaj-uzytkownika', [UzytkownikController::class, 'dodajUzytkownikaForm']);
Route::post('/dodaj-uzytkownika', [UzytkownikController::class, 'dodajUzytkownika'])->name('dodaj-uzytkownika');

Route::get('/logowanie', [UzytkownikController::class, 'pokazFormularzLogowania']);
Route::post('/zaloguj-uzytkownika', [UzytkownikController::class, 'zalogujUzytkownika'])->name('zaloguj-uzytkownika');
