<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Component;

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
}
