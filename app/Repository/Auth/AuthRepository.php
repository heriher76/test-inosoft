<?php

namespace App\Repository\Auth;

use App\Models\User;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ResponseTrait;

class AuthRepository implements AuthRepositoryInterface{
    use ResponseTrait;
    public function register(array $data){
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return $this->responseSuccess('User created successfully', 201, $user);
    }

    public function login(array $data){
        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->messages(), 400);
        }

        if (! $token = JWTAuth::attempt($data)) {
            return $this->responseError('Login credentials are invalid', 401);
        }

        return $this->responseSuccess('Login Success', 200, $token);
    }

    public function logout($token){
        JWTAuth::invalidate($token);
        return $this->responseSuccess('User Logout', 200);
    }

    public function who($token){
        $user =  JWTAuth::authenticate($token);
        return $this->responseSuccess('Success Fetch the Data', 200, $user);
    }
}