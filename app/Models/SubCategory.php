<?php

namespace App\Models;

use App\Helper\Scope\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory,StatusAttribute,OrderScope;

    protected $guarded = [];

    function category()  {
        return $this->belongsTo(Category::class,"category_id");
    }
    function products()  {
        return $this->hasMany(Product::class);
    }
}
