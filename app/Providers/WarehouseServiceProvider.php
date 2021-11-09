<?php

namespace App\Providers;

use App\Domain\Repository\WarehouseRepository;
use App\Domain\Service\Impl\WarehouseServiceImpl;
use App\Domain\Service\WarehouseService;
use App\Infrastructure\Repository\EloquentWarehouseRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class WarehouseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // ItemServiceと実装クラスを紐づける
        $this->app->bind(WarehouseService::class,WarehouseServiceImpl::class);
        $this->app->bind(WarehouseRepository::class, EloquentWarehouseRepositoryImpl::class);
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
