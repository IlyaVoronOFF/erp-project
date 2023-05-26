<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    public function getData(): array
    {
        $faker = Factory::create();

        $data = [
            [
                'fio' => 'Сергей Акимов',
                'email' => 'director@afb33.ru',
                'phone' => '+7 920 628 00 13',
                'password' => bcrypt('123123'),
                'num_pass' => '123123',
                'rule_id' => 1,
                'special_id' => $faker->numerify(mt_rand(1, 3)),
                'oklad' => $faker->numerify('#####'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fio' => 'Админ Админ',
                'email' => 'admin@afb33.ru',
                'phone' => $faker->numerify('+7 ### ### ## ##'),
                'password' => bcrypt('111222'),
                'num_pass' => '111222',
                'rule_id' => 2,
                'special_id' => $faker->numerify(mt_rand(1, 3)),
                'oklad' => $faker->numerify('#####'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // for ($i = 0; $i < 5; $i++) {
        //     $data[] = [
        //         'fio' => $faker->name(),
        //         'email' => $faker->unique()->safeEmail(),
        //         'phone' => $faker->numerify('+7 ### ### ## ##'),
        //         'password' => bcrypt('num_pass'),
        //         'num_pass' => $faker->numerify('######'),
        //         'rule_id' => $faker->numerify(mt_rand(1, 5)),
        //         'special_id' => $faker->numerify(mt_rand(1, 3)),
        //         'oklad' => $faker->numerify('#####'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }
        return $data;
    }
}