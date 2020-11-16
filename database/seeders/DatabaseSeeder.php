<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            CountrySeeder::class,
            LocationSeeder::class,
            JobCategorySeeder::class,
            UserSeeder::class,
            JobSeeder::class,
        ]);
    }
}
