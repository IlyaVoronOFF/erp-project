<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert($this->getData());
    }

    public function getData(): array
    {

        $data = [
            [
                'id' => 2,
                'name' => 'Администратор',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1,
                'name' => 'Директор',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Руководитель проекта',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Руководитель проекта + финансы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Исполнитель',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return $data;
    }
}
