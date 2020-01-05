<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Allergene;
use App\Ingredient;

class Allergene extends Model
{
    public function Ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'allergenes_ingredients', 'allergene_id', 'ingredient_id');
    }
}

