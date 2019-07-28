<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'short_description' => $faker->text,
        'intro_text' => $faker->text,
        'main_text' => $faker->paragraph,
        'cover_image' => $faker->imageUrl(),
        'alt_tag' => 'alt_tag',
        'thumbnail' => $faker->imageUrl()
        ];
});
