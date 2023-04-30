<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryInterface;
use App\Repository\Car\CarRepository;
use App\Repository\Car\CarRepositoryInterface;
use App\Repository\Motorcycle\MotorcycleRepository;
use App\Repository\Motorcycle\MotorcycleRepositoryInterface;
use App\Repository\Transaction\TransactionRepository;
use App\Repository\Transaction\TransactionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(MotorcycleRepositoryInterface::class, MotorcycleRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
