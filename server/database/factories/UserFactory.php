<?php

use App\Models\User;
use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'email_verified_at' => now(),
        'password' => 'secret',
        'mobile' => $faker->phoneNumber,
        'is_admin' => 0,
    ];
});

// factory(App\Models\User::class, 1)->create()->each(function ($user) {

//     factory(App\Models\Address::class, 1)->make()->each(function($address) use ($user) {
//           $user->addresses()->save( $address);
//     });
// });