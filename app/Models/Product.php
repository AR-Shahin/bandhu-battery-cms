<?php

namespace App\Models;

use App\Helper\Scope\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,StatusAttribute,OrderScope;
    protected $guarded = [];

    function category()  {
        return $this->belongsTo(Category::class,"category_id");
    }

    function sub_category()  {
        return $this->belongsTo(SubCategory::class,"sub_category_id");
    }
    function brand()  {
        return $this->belongsTo(Brand::class,);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoable');
    }
}
