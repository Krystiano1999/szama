<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSzczegolyZamowieniaTable extends Migration
{
    public function up()
    {
        Schema::create('szczegoly_zamowienia', function (Blueprint $table) {
            $table->id('ID_Szczegolu');
            $table->foreignId('zamowienia_id')->constrained('zamowienia','ID_Zamowienia');
            $table->foreignId('ID_Pozycji_Menu')->constrained('menu','ID_Pozycji_Menu');
            $table->integer('Ilosc');
            $table->decimal('Cena', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('szczegoly_zamowienia');
    }
}
