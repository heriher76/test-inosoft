<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Auth\AuthRepositoryInterface;

class AuthController extends Controller
{

    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository){
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        return $this->authRepository->register($request->only('name', 'email', 'password'));
    }

    public function login(Request $request)
    {
        return $this->authRepository->login($request->only('email', 'password'));
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request->header('token'));
    }

    public function who(Request $request)
    {
        return $this->authRepository->who($request->header('token'));
    }
}
