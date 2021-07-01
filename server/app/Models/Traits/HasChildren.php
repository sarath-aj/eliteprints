<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
    public function scopeParent(Builder $query)
    {
        return $query->whereNull('parent_id');
    }
}
