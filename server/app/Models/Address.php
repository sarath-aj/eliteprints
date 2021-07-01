<?php

namespace App\Models;

use App\Models\Country;
use App\Models\User;
use App\Models\Traits\CanBeDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use CanBeDefault;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'country_id','city', 'state', 'postal_code', 'is_default',
    ];

    protected $casts = [
        'default' => 'bool',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
