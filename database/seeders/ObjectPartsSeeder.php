<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('object_parts')->insert($this->getData());
    }

    public function getData(): array
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'object_id' => $faker->numerify(mt_rand(1, 20)),
                'part_id' => $faker->numerify(mt_rand(1, 4)),
                'user_id' => $faker->numerify(mt_rand(1, 5)),
                'daterange' => $faker->date('d/m/Y - d/m/Y', mt_rand()),
                'time' => $faker->numerify(mt_rand(40, 180)),
                'fot_part' => $faker->numerify('#####'),
                'description' => $faker->realText(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }
}