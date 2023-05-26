<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert($this->getData());
    }

    public function getData(): array
    {

        $data = [
            [
                'name' => 'Газоснабжение',
                'short_name' => 'ГЗС',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Обследование',
                'short_name' => 'ТЗК',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Санитарно-защитная зона',
                'short_name' => 'СЗЗ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Охрана окружающей среды',
                'short_name' => 'ООС',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return $data;
    }
}