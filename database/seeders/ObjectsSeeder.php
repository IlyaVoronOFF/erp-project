<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objects')->insert($this->getData());
    }

    public function getData(): array
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'title' => $faker->sentence(mt_rand(3, 5)),
                'code' => $faker->numerify('#####-####'),
                'daterange' => $faker->date('d/m/Y - d/m/Y', mt_rand()),
                'user_id' => $faker->numerify(mt_rand(1, 5)),
                'stage_id' => $faker->numerify(mt_rand(1, 3)),
                'project_sum' => $faker->numerify('########'),
                'plan_fot' => $faker->numerify('#######'),
                'address' => $faker->realText(10),
                'description' => $faker->realText(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }
}