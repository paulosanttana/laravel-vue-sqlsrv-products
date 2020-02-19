<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'   => 1,
        'name'          => $faker->unique()->word,
        'description'   => $faker->sentence(),
    ];
});
