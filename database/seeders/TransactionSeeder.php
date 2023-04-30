<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Car;
use App\Models\Motorcycle;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::truncate();
        Car::all()->each(function($car){
            Transaction::factory(2)->create([
                'vehicle_id' => $car->_id,
                'type' => 'car'
            ]);
        });

        Motorcycle::all()->each(function($motorcycle){
            Transaction::factory(2)->create([
                'vehicle_id' => $motorcycle->_id,
                'type' => 'motorcycle'
            ]);
        });
    }
}
