<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Meal;

class Menu extends Model
{
    public function Menu()
    {
        return $this->belongsToMany(Meal::class, 'meals_menus', 'meal_id', 'menu_id');
    }
}
