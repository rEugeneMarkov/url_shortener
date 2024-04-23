<?php

namespace App\Models\Traits;

use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, FilterInterface $filter): Builder
    {
        $filter->apply($builder);

        return $builder;
    }
}
