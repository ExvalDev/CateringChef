<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public function Component()
    {
        return $this->belongsToMany(Component::class, 'components_meals', 'meal_id', 'component_id');
    }
}
