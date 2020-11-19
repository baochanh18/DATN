<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
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
        return [
            'user_id' => User::factory(),
            'job_title' => $this->faker->jobTitle,
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'active_day' => $this->faker->date('Y-m-d', 'now'),
            'company_descriptions' => $this->faker->realText(500),
            'company_size' => rand(0, 9),
        ];
    }
}
