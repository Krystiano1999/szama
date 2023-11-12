<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restauracje extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_Restauracji';
    protected $fillable = [
        'Nazwa_Restauracji',
        'Wojewodztwo',
        'Miasto',
        'Adres',
        'Opis',
    ];

    protected $table = 'restauracje';
}
