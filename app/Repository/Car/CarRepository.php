<?php

namespace App\Repository\Car;

use App\Models\Car;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ResponseTrait;

class CarRepository implements CarRepositoryInterface{
    use ResponseTrait;

    public function getAll(){
        $cars = Car::all();
        return $this->responseSuccess('Success Fetch Car Data', 200, $cars);
    }

    public function store(array $data){
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'release_year' => 'required|numeric',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'engine' => 'required',
            'seats' => 'required|numeric',
            'type' => 'required|string',
            'stock' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        $car = Car::create([
            'name' => $data['name'],
            'release_year' => $data['release_year'],
            'color' => $data['color'],
            'price' => $data['price'],
            'engine' => $data['engine'],
            'seats' => $data['seats'],
            'type' => $data['type'],
            'stock' => $data['stock'],
        ]);

        return $this->responseSuccess('Car data created successfully', 201, $car);
    }

    public function destroy($id){
        $car = Car::find($id);
        if(!$car) {
            return $this->responseError('Car Not Found', 400);
        }
        $car->delete();
        return $this->responseSuccess('Car Deleted', 200);
    }

    public function checkStock($id){
        $car = Car::find($id);
        
        if(!$car) {
            return $this->responseError('Car Not Found', 400);
        }
        return $this->responseSuccess('Success Fetch Car Data', 200, [
            'name' => $car->name,
            'stock' => $car->stock
        ]);
    }

    public function transactions($id){
        $car = Car::with(['transactions' => function($query) {
            $query->where('type', 'car');
        }])->find($id);

        if(!$car) {
            return $this->responseError('Car Not Found', 400);
        }

        return $this->responseSuccess('Success Fetch Car Data', 200, $car);
    }
}