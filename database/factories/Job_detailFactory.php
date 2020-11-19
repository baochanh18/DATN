<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Job_detail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Job_detailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job_detail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'job_level' => rand(0 ,3),
            'job_type' => rand(0, 5),
            'job_salary_type' => rand(0 ,1),
            'job_minimum_salary' => rand(300, 1500),
            'job_maximum_salary' => rand(2000, 3000),
            'job_description' => $this->faker->realText(1000),
            'job_requirement' => $this->faker->realText(500),
            'cv_language' => $this->faker->country,
            'contact_name' => $this->faker->name,
            'contact_email' => $this->faker->email
        ];
    }
}
