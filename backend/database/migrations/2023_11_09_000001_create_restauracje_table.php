<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestauracjeTable extends Migration
{
    public function up()
    {
        Schema::create('restauracje', function (Blueprint $table) {
            $table->id('ID_Restauracji');
            $table->string('Nazwa_Restauracji');
            $table->string('Wojewodztwo');
            $table->string('Miasto');
            $table->string('Adres');
            $table->text('Opis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restauracje');
    }
}
