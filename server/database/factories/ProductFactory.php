<?php

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */

$factory->define(Product::class, function (Faker $faker) {
    $name = 'T Shirt ' . $faker->unique()->randomNumber($nbDigits = 8);

    return [
        'product_code' => 'PRC' . $faker->unique()->randomNumber(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $faker->sentence(10),
            'price' => $faker->numberBetween(100, 600),
            'featured' => 0,
            'occasion' => $faker->randomElement(['sports', 'casual', 'formal', 'party', 'beach Wear', 'lounge Wear']),
            'brand_id' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
            'gender' => 'women',
            'sleeve' => $faker->randomElement(['full', 'half', 'sleeveless', 'short']),
            'neck' => $faker->randomElement(['polo', 'round', 'collared', 'v', 'hooded']),
            'color' => $faker->randomElement(['green', 'blue', 'black', 'pink', 'red', 'white', 'orange']),
            'fit' => $faker->randomElement(['boxy', 'compression', 'loose', 'slim', 'regular']),
            // 'main_image' => 'uploads/men-t-shirt.webp',
            'main_image' => 'uploads/women-t-shirt.jpg',

    ];
});
