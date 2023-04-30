<?php

namespace App\Repository\Motorcycle;

use App\Models\Motorcycle;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ResponseTrait;

class MotorcycleRepository implements MotorcycleRepositoryInterface{
    use ResponseTrait;

    public function getAll(){
        
    }

    public function store(array $data){
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'release_year' => 'required|numeric',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'engine' => 'required',
            'suspension' => 'required|string',
            'transmission' => 'required|string',
            'stock' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        $motorcycle = Motorcycle::create([
            'name' => $data['name'],
            'release_year' => $data['release_year'],
            'color' => $data['color'],
            'price' => $data['price'],
            'engine' => $data['engine'],
            'suspension' => $data['suspension'],
            'transmission' => $data['transmission'],
            'stock' => $data['stock'],
        ]);

        return $this->responseSuccess('Motorcycle data created successfully', 201, $motorcycle);
    }

    public function checkStock($id){
        $motorcycle = Motorcycle::find($id);
        
        if(!$motorcycle) {
            return $this->responseError('Motorcycle Not Found', 400);
        }
        return $this->responseSuccess('Success Fetch Motorcycle Data', 200, [
            'name' => $motorcycle->name,
            'stock' => $motorcycle->stock
        ]);
    }

    public function transactions($id){
        $Motorcycle = Motorcycle::with(['transactions' => function($query) {
            $query->where('type', 'motorcycle');
        }])->find($id);

        if(!$Motorcycle) {
            return $this->responseError('Motorcycle Not Found', 400);
        }

        return $this->responseSuccess('Success Fetch Motorcycle Data', 200, $Motorcycle);
    }

    public function destroy($id){
        $motorcycle = Motorcycle::find($id);
        if(!$motorcycle) {
            return $this->responseError('Motorcycle Not Found', 400);
        }
        $motorcycle->delete();
        return $this->responseSuccess('Motorcycle Deleted', 200);
    }
}