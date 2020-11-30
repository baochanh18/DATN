<?php

namespace Database\Factories;

use App\Models\Company_profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Company_profileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company_profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->text(100),
            'company_size' => rand(0,9),
            'website_url' => $this->faker->url ,
            'contact_office_name' => $this->faker->company ,
            'contact_office_phone' => $this->faker->phoneNumber,
            'contact_office_email' => $this->faker->email ,
            'contact_person_name' => $this->faker->name ,
            'contact_person_phone' => $this->faker->phoneNumber ,
        ];
    }
}
