<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use App\Helper\Scope\OrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,StatusAttribute,OrderScope;

    protected $guarded = [];

    function get(...$params) {
        return self::orderBy("order","asc")->get([...$params]);
    }

    function sub_categories()  {
        return $this->hasMany(SubCategory::class);
    }

    function products()  {
        return $this->hasMany(Product::class);
    }
}
