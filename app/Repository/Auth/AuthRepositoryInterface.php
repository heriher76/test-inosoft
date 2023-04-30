<?php

namespace App\Repository\Auth;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout($token);
    public function who($token);
}