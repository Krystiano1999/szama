<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorieTable extends Migration
{
    public function up()
    {
        Schema::create('kategorie', function (Blueprint $table) {
            $table->id('ID_Kategorii');
            $table->string('Nazwa_Kategorii');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategorie');
    }
}
