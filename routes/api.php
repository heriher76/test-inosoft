<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MotorcycleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('register');
    Route::get('who', [AuthController::class, 'who'])->name('who');

    Route::group(['prefix' => 'car', 'as' => 'car::'], function(){
        Route::get('/', [CarController::class, 'index'])->name('index');
        Route::post('/', [CarController::class, 'store'])->name('store');
        Route::post('/sold', [CarController::class, 'carSold'])->name('sold');
        Route::get('/checkStock/{id}', [CarController::class, 'checkStock'])->name('stock');
        Route::get('/transactions/{id}', [CarController::class, 'getTransactions'])->name('transaction');
        Route::delete('/{id}', [CarController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'motorcycle', "as" => "motorcycle::"], function(){
        Route::get('/', [MotorcycleController::class, 'index'])->name('index');
        Route::post('/', [MotorcycleController::class, 'store'])->name('store');
        Route::post('/sold', [MotorcycleController::class, 'motorcycleSold'])->name('sold');
        Route::get('/checkStock/{id}', [MotorcycleController::class, 'checkStock'])->name('stock');
        Route::get('/transactions/{id}', [MotorcycleController::class, 'getTransactions'])->name('transaction');
        Route::delete('/{id}', [MotorcycleController::class, 'destroy'])->name('delete');
    });
});
