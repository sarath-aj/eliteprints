<?php

namespace App\Filters\Product;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class FitFilter extends FilterAbstract
{
    /**
     * Mappings for database values.
     *
     * @return array
     */

    /**
     * Filter by product sleeve type.
     *
     * @param  string $type
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $values)
    {
        if ($values === null) {
            return $builder;
        }

        return $builder->whereIn('fit', $values);
    }
}
