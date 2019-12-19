<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;

class Supplier extends Model
{
    public function Ingredient() 
    {
        return $this->hasMany(Ingredient::class);
    }
}
