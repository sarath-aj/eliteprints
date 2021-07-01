<?php

use App\Models\ProductVariationType;
use App\Models\Product;

use Faker\Generator as Faker;

$factory->define(App\Models\ProductVariation::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)->create()->id,
        'name' => $faker->unique()->name,
        'type_id' => factory(ProductVariationType::class)->create()->id
    ];
});
