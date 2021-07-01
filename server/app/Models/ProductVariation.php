<?php

namespace App\Models;

use App\Models\Collections\ProductVariationCollection;
use App\Models\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasPrice;
    use SoftDeletes;

    public function getPriceAttribute($value)
    {
        if ($value === null) {
            return $this->product->price;
        }

        return $value;
    }

    public function priceVaries(): bool
    {
        return !$this->money->equals($this->product->money);
    }

    public function type()
    {
        return $this->belongsTo(ProductVariationType::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        return $this->belongsToMany(self::class, 'product_variation_stock_view')
            ->withPivot(['stock', 'in_stock']);
    }

    public function stockCount(): int
    {
        return $this->stock->first()->pivot->stock;
    }

    public function inStock(): bool
    {
        return (bool) $this->stock->first()->pivot->in_stock;
    }

    public function minStock($amount): int
    {
        return min($this->stockCount(), $amount);
    }

    public function newCollection(array $models = [])
    {
        return new ProductVariationCollection($models);
    }
}
