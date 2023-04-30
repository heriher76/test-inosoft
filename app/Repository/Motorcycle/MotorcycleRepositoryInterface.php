<?php

namespace App\Repository\Motorcycle;

interface MotorcycleRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function checkStock($id);
    public function transactions($id);
    public function destroy($id);
}