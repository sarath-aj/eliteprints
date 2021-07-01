<?php

use App\Models\Address;
use App\Models\User;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'country_id' => function () {
            return Country::all()->random()->id;
        },
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'state' => $faker->state,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'is_default' => 1,
    ];
});