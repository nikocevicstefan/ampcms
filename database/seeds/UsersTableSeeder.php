<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Stefan',
            'last_name' => 'Nikocevic',
            'job_title' => 'Back End Engineer',
            'username' => 'admin',
            'password' => Hash::make('admin'), // password
            'profile_image' => 'avatar.png',
            'is_admin' => true,
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Stefan',
            'last_name' => 'Nikocevic',
            'job_title' => 'Back End Engineer',
            'username' => 'moderator',
            'password' => Hash::make('moderator'), // password
            'profile_image' => 'avatar.png',
            'is_admin' => false,
            'remember_token' => Str::random(10),
        ]);
    }
}
