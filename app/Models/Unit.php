<?php

namespace App\Models;

use App\Helper\Scope\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory, StatusAttribute, OrderScope;
    protected $guarded = [];

    // You can add relationships here if needed
    // function products()  {
    //     return $this->hasMany(Product::class);
    // }
}
