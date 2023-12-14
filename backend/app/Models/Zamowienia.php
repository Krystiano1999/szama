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
        'ID_Uzytkownika', 'Status_Zamowienia', 'Cena', 'ID_Restauracji'
    ];

    public function szczegoly()
    {
        return $this->hasMany(SzczegolyZamowienia::class, 'zamowienia_id');
    }

    public function restauracja()
    {
        return $this->belongsTo(Restauracje::class, 'ID_Restauracji');
    }
}