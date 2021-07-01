<?php

namespace App\Models;

use App\Models\Traits\HasPrice;
use App\Models\Traits\HasScopes;
use App\Models\Brand;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Filters\Product\ProductFilters;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasScopes, HasPrice;
    use SoftDeletes;

    protected $fillable = [
        'product_code', 'name', 'slug', 'description', 'price', 'featured', 'gender', 'sleeve', 'neck', 'color', 'fit', 'occasion', 'main_image', 'image_gallery', 'brand_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }

    public function stockCount()
    {
        return $this->variations->sum(function ($variation) {
            return $variation->stockCount();
        });
    }

    public function inStock(): bool
    {
        return $this->stockCount() > 0;
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new ProductFilters($request))->add($filters)->filter($builder);
    }
}