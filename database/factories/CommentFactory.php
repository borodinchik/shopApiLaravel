<?php

use Faker\Generator as Faker;
use App\Product;
use App\User;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'product_id' => function ()
        {
            return Product::all()->random();
        },
        'user_id' => function ()
        {
            return User::all()->random();
        }
    ];
});
