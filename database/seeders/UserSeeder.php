<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company_profile;
use App\Models\User;
use App\Models\User_profile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(User_profile::factory()->has(Address::factory()))
            ->create([
           'email' => 'admin@gmail.com',
           'role' => 2,
        ]);

        User::factory()
            ->has(User_profile::factory()->hasAddress())
            ->count(10)
            ->create([
                'role' => 2,
            ]);

        User::factory()
            ->has(Company_profile::factory()->hasAddresses(3))
            ->count(100)
            ->create([
                'role' => 1,
            ]);

        User::factory()
            ->has(User_profile::factory()->hasAddress())
            ->count(1000)
            ->create([
                'role' => 0,
            ]);
    }
}
