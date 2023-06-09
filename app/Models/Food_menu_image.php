<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_menu_image extends Model
{
    use HasFactory;


    protected $fillable = [
        'food_menu_id',
        'image_name',
    ];




    public function getUserInfo(){

        return $this->belongsTo(User::class, 'food_menu_id', 'id');

    }
}