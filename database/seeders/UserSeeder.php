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
                'userable_id' => 1,
                'userable_type' => 'App\Models\User_profile',
            ]);

        for ($i = 2; $i <= 11; $i++){
            User::factory()
                ->has(User_profile::factory()->hasAddress())
                ->create([
                    'role' => 2,
                    'userable_id' => $i,
                    'userable_type' => 'App\Models\User_profile',
            ]);
        }

        for($i = 1; $i <= 100; $i++) {
            User::factory()
                ->has(Company_profile::factory()->hasAddresses(3))
                ->create([
                    'role' => 1,
                    'userable_id' => $i,
                    'userable_type' => 'App\Models\Company_profile',
                ]);
        }

        for($i = 12; $i <= 1011; $i++) {
            User::factory()
                ->has(User_profile::factory()->hasAddress())
                ->create([
                    'role' => 0,
                    'userable_id' => $i,
                    'userable_type' => 'App\Models\User_profile',
                ]);
        }
        for($i = 1012; $i <= 1511; $i++) {
            User::factory()
                ->has(User_profile::factory()->hasAddress())
                ->create([
                    'role' => 0,
                    'isActive' => 0,
                    'userable_id' => $i,
                    'userable_type' => 'App\Models\User_profile',
                ]);
        }
    }
}
