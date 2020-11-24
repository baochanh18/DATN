<?php

namespace Database\Factories;

use App\Models\Benefit;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BenefitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Benefit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'benefits_description' => $this->faker->realText(15),
        ];
    }
}
