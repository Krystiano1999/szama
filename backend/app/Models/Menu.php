<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $table = 'menu';

    protected $fillable = [
        'nazwa_dania',
        'cena',
        'opis',
        'kategoria_id', // Aby powiązać z kategorią
    ];

    public function kategoria()
    {
        return $this->belongsTo(Kategorie::class, 'kategoria_id');
    }
}
