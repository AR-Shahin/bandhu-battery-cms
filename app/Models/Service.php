<?php

namespace App\Models;

use App\Helper\Scope\OrderScope;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Attribute\StatusAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory,StatusAttribute,OrderScope;
    protected $guarded = [];
}

