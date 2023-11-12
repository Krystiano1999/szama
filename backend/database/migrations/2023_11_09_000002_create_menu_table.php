<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('ID_Pozycji_Menu');
            $table->foreignId('ID_Restauracji')->constrained('restauracje', 'ID_Restauracji');
            $table->string('Nazwa_Pozycji');
            $table->text('Opis_Pozycji');
            $table->decimal('Cena', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropForeign(['ID_Restauracji']);
        });

        Schema::dropIfExists('menu');
    }
}
