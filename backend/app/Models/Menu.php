<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'ID_Pozycji_Menu';


    protected $table = 'menu';

    protected $fillable = [
        'Nazwa_Pozycji', 
        'Cena',         
        'Opis_Pozycji', 
        'kategoria_id',  
        'ID_Restauracji' 
    ];

    // Relacja z kategorią
    public function kategoria()
    {
        return $this->belongsTo(Kategorie::class, 'kategoria_id');
    }

    // Relacja z restauracją, jeśli to konieczne
    public function restauracja()
    {
        return $this->belongsTo(Restauracje::class, 'ID_Restauracji');
    }
}
