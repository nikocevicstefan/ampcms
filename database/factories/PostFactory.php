<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $user = new User();
    $authors = $user->allAuthorsId();

    return [
        'author_id' => 1,
        'cover_image' => $faker->imageUrl(),
        'alt_tag' => 'alt_tag',
        'title' => $faker->sentence,
        'introductory_content' => $faker->text,
        'main_content' => $faker->paragraph,
        'tags' => $faker->sentence,
        'locale' => 'en',
        'views' => 0
    ];
});

