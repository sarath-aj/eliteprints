<?php

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'email_verified_at' => now(),
        'password' => 'admin',
        'mobile' => $faker->phoneNumber,
        'is_admin' => 1,
    ];
});