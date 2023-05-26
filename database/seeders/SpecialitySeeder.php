<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('speciality')->insert($this->getData());
    }

    public function getData(): array
    {

        $data = [
            [
                'name' => 'Инженер',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Менеджер',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Фрилансер',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return $data;
    }
}