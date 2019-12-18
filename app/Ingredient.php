<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Supplier;

class Ingredient extends Model
{
    public function Allergene()
    {
        return $this->belongsToMany(Allergene::class, 'allergene_ingredient', 'ingredient_id', 'allergene_id');
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    } 
}


