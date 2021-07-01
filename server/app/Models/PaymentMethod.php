<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_type', 'last_four', 'default', 'provider_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
