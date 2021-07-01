<?php

namespace App\Models;

use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\PasswordHistory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Traits\RolesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, RolesTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'is_admin', 'customer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return int
     */
    // the identifier is just going to be primary key for the user
    public function getJWTIdentifier(): int
    {
        return $this->getKey(); // returns user id
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Password mutator
     *
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function cart()
    {
        return $this->belongsToMany(ProductVariation::class, 'cart_user')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($password = Arr::get($user->getChanges(), 'password')) {
                $user->storeCurrentPasswordInHistory($password);
            }
        });

        static::created(function ($user) {
            $user->storeCurrentPasswordInHistory($user->password);
        });
    }

    public function storeCurrentPasswordInHistory()
    {
        return $this->passwordHistory()->create([
            'password' => $this->password
        ]);
    }

    public function passwordHistory()
    {
        return $this->hasMany(PasswordHistory::class)->latest();
    }

    public function deletePasswordHistory($keep = 5)
    {
        $this->passwordHistory()->where('id', '<=', $this->passwordHistory()->first()->id - $keep)->delete();
    }
}