<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarTransaction extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\BarItem', 'bar_item_id', 'id');
    }
}
