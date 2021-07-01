<?php

namespace App\Models;

use App\Models\User;
use App\Money\Money;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const PAYMENT_FAILED = 'payment_failed';
    const COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_id', 'shipping_method_id', 'payment_method_id', 'status', 'subtotal', 'tax', 'total',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Order $order) {
            $order->status = self::PENDING;
        });
    }

    public function getSubtotalAttribute()
    {
        return new Money($this->attributes['subtotal']);
    }

    public function getSubtotalUnformattedAttribute()
    {
        return $this->attributes['subtotal'];
    }
    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->money);
    }
    public function totalUnformatted()
    {
        return $this->subtotalUnformatted + $this->shippingMethod->price;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function products()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation_order')
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}