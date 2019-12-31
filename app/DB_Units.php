<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Component;
use App\Show_Units;

class DB_Units extends Model
{
    public function Ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function Component()
    {
        return $this->hasMany(Component::class);
    }

    public function Show_Units()
    {
        return $this->hasMany(Show_Units::class);
    }
}
