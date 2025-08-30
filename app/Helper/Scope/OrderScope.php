<?php
namespace App\Helper\Scope;
use Illuminate\Database\Eloquent\Builder;

trait OrderScope{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc')->latest();
        });
    }
}
