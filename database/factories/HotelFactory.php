<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hotel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Hotel::class, function (Faker $faker) {
    $faker->addProvider(new Liior\Faker\Prices($faker));

    return [
        'name' => $faker->company,
        'price' => $faker->price(100, 20000, true, true),
        'bedrooms' => $faker->numberBetween(1,10),
        'bathrooms' => $faker->numberBetween(1,10),
        'storeys' => $faker->numberBetween(1,10),
        'garages' => $faker->numberBetween(1,10),
    ];
});
