<?php

use App\JobPosting;
use Illuminate\Database\Seeder;

class JobPostingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(JobPosting::class, 7)->create();
    }
}
