<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\DB_Units;
use App\Meal;

class Component extends Model
{
    public function Ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'components_ingredients', 'component_id', 'ingredient_id');
    }

    public function DB_Units()
    {
        return $this->belongsTo(DB_Units::class);
    }

    public function Meal()
    {
        return $this->belongsToMany(Meal::class, 'components_meals', 'component_id', 'meal_id');
    }
}
