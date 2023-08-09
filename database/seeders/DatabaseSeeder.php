<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //RulesSeeder::class,
            //StagesSeeder::class,
            //PartsSeeder::class,
            //SpecialitySeeder::class,
            //ClientsSeeder::class,
            //UsersPartsSeeder::class,
            //UsersSeeder::class,
            //ObjectsSeeder::class,
            //ObjectPartsSeeder::class,
        ]);
    }
}