<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantRegistrationModel extends Model
{
    use HasFactory;

    protected $table = 'rejestracja_restauracji';
    
    protected $fillable = [
        'owner_name', 
        'restaurant_name', 
        'province', 
        'city', 
        'address', 
        'description', 
        'email', 
        'phone_number'
    ];
}
