<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\DB_Units;

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
}
