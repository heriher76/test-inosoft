<?php

namespace App\Repository\Transaction;

interface TransactionRepositoryInterface{
    public function carSold(array $data);
    public function motorcycleSold(array $data);
}