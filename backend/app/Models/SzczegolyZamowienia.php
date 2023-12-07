<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SzczegolyZamowienia extends Model
{
    use HasFactory;

    protected $table = 'szczegoly_zamowienia';
    protected $primaryKey = 'ID_Szczegolu';

    protected $fillable = [
        'zamowienia_id', 'ID_Pozycji_Menu', 'Ilosc', 'Cena'
    ];

    public function zamowienie()
    {
        return $this->belongsTo(Zamowienie::class, 'zamowienia_id');
    }
}
