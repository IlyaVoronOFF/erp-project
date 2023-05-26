<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert($this->getData());
    }

    public function getData(): array
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->numerify('+7 ### ### ## ##'),
                'address' => $faker->realText(10),
                'description' => $faker->realText(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }
}
