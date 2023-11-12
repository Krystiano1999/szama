<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorie extends Model
{
    use HasFactory;
    protected $table = 'kategorie';
    protected $fillable = [
        'nazwa_kategorii',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategoria_id');
    }
}
