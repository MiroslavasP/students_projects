<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');

        foreach (range(1, 20) as $_) {
            $name = $faker->firstName;
            $surname = $faker->lastName;
            DB::table('students')->insert([
                'full_name' => $name . ' ' . $surname,
                'group_id' => 0,
                'project_id' => 0
            ]);
        }
    }
}
