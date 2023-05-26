<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert($this->getData());
    }

    public function getData(): array
    {

        $data = [
            [
                'name' => 'Проект для экспертизы',
                'short_name' => 'П',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Рабочий проект',
                'short_name' => 'Р',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Проект для экспертизы + Рабочий проект',
                'short_name' => 'П + Р',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return $data;
    }
}