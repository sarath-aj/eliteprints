<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_name', 'description', 'email', 'phone', 'address', 'state', 'city', 'postal_code', 'country_id'
    ];

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
