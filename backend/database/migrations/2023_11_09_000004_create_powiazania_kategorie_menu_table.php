<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowiazaniaKategorieMenuTable extends Migration
{
    public function up()
    {
        Schema::create('powiazania_kategorie_menu', function (Blueprint $table) {
            $table->id('ID_Powiazania');
            $table->foreignId('ID_Pozycji_Menu')->constrained('menu', 'ID_Pozycji_Menu');
            $table->foreignId('ID_Kategorii')->constrained('kategorie', 'ID_Kategorii');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('powiazania_kategorie_menu');
    }
}
