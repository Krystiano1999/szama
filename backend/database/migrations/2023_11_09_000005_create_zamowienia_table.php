<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZamowieniaTable extends Migration
{
    public function up()
    {
        Schema::create('zamowienia', function (Blueprint $table) {
            $table->id('ID_Zamowienia');
            $table->foreignId('ID_Uzytkownika')->constrained('users');
            $table->string('Status_Zamowienia');
            $table->decimal('Cena', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zamowienia');
    }
}
