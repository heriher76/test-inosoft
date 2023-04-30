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
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(MotorcycleSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
