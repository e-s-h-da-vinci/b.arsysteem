<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BowUse extends Model
{
    public function bow()
    {
        return $this->belongsTo('App\Models\Bow', 'bows_id', 'id');
    }
}
