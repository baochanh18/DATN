<?php

namespace Database\Seeders;

use App\Models\Job_category;
use App\Models\Job_detail;
use App\Models\User;
use Faker\Provider\Company;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_categories = Job_category::all();
        Job_detail::all()->each(function ($job_detail) use ($job_categories){
           $job_detail->addresses()->attach(
             User::find($job_detail->job->user_id)->companyProfile->addresses->random(rand(1, 3))->pluck('id')->toArray()
           );
            $job_detail->jobCategories()->attach(
                $job_categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
