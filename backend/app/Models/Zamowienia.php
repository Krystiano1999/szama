<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zamowienia extends Model
{
    use HasFactory;

    protected $table = 'zamowienia';
    protected $primaryKey = 'ID_Zamowienia';

    protected $fillable = [
        'ID_Uzytkownika', 'Status_Zamowienia', 'Cena'
    ];

    public function szczegoly()
    {
        return $this->hasMany(SzczegolyZamowienia::class, 'zamowienia_id');
    }
}
