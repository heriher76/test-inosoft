<?php

namespace App\Repository\Transaction;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ResponseTrait;

class TransactionRepository implements TransactionRepositoryInterface{
    use ResponseTrait;

    public function carSold(array $data){

        $validator = Validator::make($data, [
            'car_id' => 'required',
            'buyer_name' => 'required',
            'unit' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        $car = Car::find($data['car_id']);
        
        if(!$car) {
            return $this->responseError('Car Not Found', 400);
        }

        if($car->stock - $data['unit'] < 0){
            return $this->responseError('Not Enough Unit for Sale', 400);
        }

        if($car->stock <= 0){
            return $this->responseError('Out of Stock', 400);
        }

        $car->stock -= $data['unit'];
        $car->save();

        $transaction = Transaction::create([
            'purchase_date' => now()->toDateString(),
            'buyer_name' => $data['buyer_name'],
            'unit' => $data['unit'],
            'vehicle_id' => $car->_id,
            'type' => 'car'
        ]);
        return $this->responseSuccess('Transaction created successfully', 201, $transaction);
    }

    public function motorcycleSold(array $data){
        $validator = Validator::make($data, [
            'motorcycle_id' => 'required',
            'buyer_name' => 'required',
            'unit' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        $motorcycle = Motorcycle::find($data['motorcycle_id']);
        
        if(!$motorcycle) {
            return $this->responseError('Motorcycle Not Found', 400);
        }

        if($motorcycle->stock - $data['unit'] < 0){
            return $this->responseError('Not Enough Unit for Sale', 400);
        }

        if($motorcycle->stock <= 0){
            return $this->responseError('Out of Stock', 400);
        }

        $motorcycle->stock -= $data['unit'];
        $motorcycle->save();
        $transaction = Transaction::create([
            'purchase_date' => now()->toDateString(),
            'buyer_name' => $data['buyer_name'],
            'unit' => $data['unit'],
            'vehicle_id' => $motorcycle->_id,
            'type' => 'motorcycle'
        ]);
        return $this->responseSuccess('Transaction created successfully', 201, $transaction);
    }
}