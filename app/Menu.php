<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Meal;

class Menu extends Model
{
    public function Meal()
    {
        return $this->belongsToMany(Meal::class, 'meals_menus',  'menu_id', 'meal_id')->withTimestamps();
    }
}
