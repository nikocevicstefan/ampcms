<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => 'Stefan',
        'last_name' => 'Nikocevic',
        'job_title' => 'Back End Engineer',
        'username' => 'stefannik',
        'password' => Hash::make('stefan1995'), // password
        'profile_image' => 'avatar.png',
        'is_admin' => true,
        'remember_token' => Str::random(10),
    ];
});
