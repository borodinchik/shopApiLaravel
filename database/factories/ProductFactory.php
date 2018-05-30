<?php

use Faker\Generator as Faker;
use App\Manufacturer;
use App\Product;
use App\User;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->paragraph,
        'price' => $faker->randomFloat(null, 100, 5000 ),
        'company_id' => function()
        {
            return Manufacturer::all()->random();
        },
    ];
});
