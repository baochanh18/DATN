<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company_profile;
use App\Models\Country;
use App\Models\Cv;
use App\Models\Job_contact;
use App\Models\Job_desire;
use App\Models\Job_detail;
use App\Models\Location;
use App\Models\User_profile;
use App\Models\Work_exp;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'job_desire_id' => Job_desire::factory() ,
//            'work_exp_id' => Work_exp::factory() ,
//            'company_profile_id' => Company_profile::factory() ,
//            'job_contact_id' => Job_contact::factory() ,
//            'job_detail_id' => Job_detail::factory() ,
            'address_name' => $this->faker->country,
            'city_id' => rand(1, 63),
            'address' => $this->faker->address ,
//            'location_id' => rand(1,709),
//            'user_profile_id' => User_profile::factory() ,
//            'cv_id' => Cv::factory()
        ];
    }
}
