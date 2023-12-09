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
        'user_id',
    ];

    protected $table = 'restauracje';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
