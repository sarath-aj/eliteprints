<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasPrice;

class ShippingMethod extends Model
{
    use HasPrice;
    protected $fillable = [
        'name', 'price',
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
