<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_title',
        'food_description',
        'veg_status',
        'price',
        'discount_per',
        'menu_profile_img_id',
        'active_status',
    ];
}