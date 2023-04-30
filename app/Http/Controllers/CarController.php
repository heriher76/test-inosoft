<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Car\CarRepositoryInterface;
use App\Repository\Transaction\TransactionRepositoryInterface;

class CarController extends Controller
{
    private CarRepositoryInterface $carRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(CarRepositoryInterface $carRepository, TransactionRepositoryInterface $transactionRepository){
        $this->carRepository = $carRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function index(){
        return $this->carRepository->getAll();
    }

    public function store(Request $request){
        return $this->carRepository->store($request->only('name', 'release_year', 'color', 'price', 'engine', 'seats', 'type', 'stock'));
    }

    public function destroy($id){
        return $this->carRepository->destroy($id);
    }

    public function checkStock($id){
        return $this->carRepository->checkStock($id);
    }

    public function getTransactions($id){
        return $this->carRepository->transactions($id);
    }

    public function carSold(Request $request){
        return $this->transactionRepository->carSold($request->only('car_id', 'buyer_name', 'unit'));
    }
}
