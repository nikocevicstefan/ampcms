<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Job;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
    ];
});
