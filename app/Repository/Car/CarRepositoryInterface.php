<?php

namespace App\Repository\Car;

interface CarRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function destroy($id);
    public function checkStock($id);
    public function transactions($id);
}