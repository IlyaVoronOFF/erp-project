<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert($this->getData());
    }

    public function getData(): array
    {

        $data = [
            [
                'id' => 1,
                'name' => 'Архив',
                'color' => '#908d8d',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return $data;
    }
}