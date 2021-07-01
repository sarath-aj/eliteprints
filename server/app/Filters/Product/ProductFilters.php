<?php

namespace App\Filters\Product;

use App\Filters\FiltersAbstract;

use App\Filters\Product\PriceFilter;
use App\Filters\Product\BrandFilter;
use App\Filters\Product\SleeveTypeFilter;
use App\Filters\Product\NeckTypeFilter;
use App\Filters\Product\FitFilter;
use App\Filters\Product\ColorFilter;
use App\Filters\Product\Ordering\ViewsOrder;

class ProductFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'price' => PriceFilter::class,
        'brand_id' => BrandFilter::class,
        'sleeve' => SleeveTypeFilter::class,
        'neck' => NeckTypeFilter::class,
        'fit' => FitFilter::class,
        'color' => ColorFilter::class,
        'views' => ViewsOrder::class
    ];
}
