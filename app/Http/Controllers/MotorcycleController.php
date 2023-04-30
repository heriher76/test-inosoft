<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Motorcycle\MotorcycleRepositoryInterface;
use App\Repository\Transaction\TransactionRepositoryInterface;

class MotorcycleController extends Controller
{
    private MotorcycleRepositoryInterface $motorcycleRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(MotorcycleRepositoryInterface $motorcycleRepository, TransactionRepositoryInterface $transactionRepository){
        $this->motorcycleRepository = $motorcycleRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function index(){
        return $this->motorcycleRepository->getAll();
    }

    public function store(Request $request){
        return $this->motorcycleRepository->store($request->only('name', 'release_year', 'color', 'price', 'engine', 'suspension', 'transmission', 'stock'));
    }

    public function destroy($id){
        return $this->motorcycleRepository->destroy($id);
    }

    public function checkStock($id){
        return $this->motorcycleRepository->checkStock($id);
    }

    public function getTransactions($id){
        return $this->motorcycleRepository->transactions($id);
    }

    public function motorcycleSold(Request $request){
        return $this->transactionRepository->motorcycleSold($request->only('motorcycle_id', 'buyer_name', 'unit'));
    }
}
