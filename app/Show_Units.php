<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DB_Units;

class Show_Units extends Model
{
    public function DB_Units()
    {
        return $this->belongsTo(DB_Units::class);
    }
}
