<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\JobPosting;
use App\Model;
use Faker\Generator as Faker;

$factory->define(JobPosting::class, function (Faker $faker) {
    return [
        'cover_image' => $faker->imageUrl(),
        'alt_tag' => 'alt_tag',
        'title' => $faker->sentence,
        'job_title' => $faker->jobTitle,
        'job_description' => $faker->paragraph,
        'beginning_date' => $faker->date(),
        'ending_date' => $faker->date(),
    ];
});
