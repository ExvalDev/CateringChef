<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Supplier;
use App\DB_Units;
use App\Component;

class Ingredient extends Model
{
    public function Allergene()
    {
        return $this->belongsToMany(Allergene::class, 'allergenes_ingredients', 'ingredient_id', 'allergene_id')->withTimestamps();
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    } 

    public function DB_Units()
    {
        return $this->belongsTo(DB_Units::class);
    }  

    public function Component()
    {
        return $this->belongsToMany(Component::class, 'components_ingredinets', 'ingredient_id', 'component_id');
    }
}


