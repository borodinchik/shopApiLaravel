<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Manufacturer;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create();
        factory(Manufacturer::class, 300)->create();
        factory(Product::class, 300)->create();
        factory(Comment::class, 300)->create();
    }
}
