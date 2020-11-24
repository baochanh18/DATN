<?php

namespace Database\Factories;

use App\Enums\JobStatus;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::now();
        return [
            'user_id' => User::factory(),
            'job_title' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'active_day' => $now->subDay(rand(1,22)),
            'company_descriptions' => $this->faker->realText(500),
            'company_size' => rand(0, 9),
            'job_status' => JobStatus::Active,
        ];
    }
}
