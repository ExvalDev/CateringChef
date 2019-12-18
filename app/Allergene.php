<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Allergene;

class Allergene extends Model
{
    public function Ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'allergene_ingredient', 'allergene_id', 'ingredient_id');
    }
}

