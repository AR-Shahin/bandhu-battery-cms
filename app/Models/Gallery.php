<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    function scopeIsFront($query)
    {
        return $query->where('is_front', true);
    }
}
