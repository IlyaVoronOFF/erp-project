<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_parts')->insert($this->getData());
    }

    public function getData(): array
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'user_id' => $faker->numerify(mt_rand(1, 7)),
                'part_id' => $faker->numerify(mt_rand(1, 4)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }
}