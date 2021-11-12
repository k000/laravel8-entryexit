<?php

namespace App\Providers;

use App\Domain\Factory\Impl\StockFactoryImpl;
use App\Domain\Factory\StockFactory;
use App\Domain\Repository\StockRepository;
use App\Domain\Service\Impl\StockServiceImpl;
use App\Domain\Service\StockService;
use App\Infrastructure\Repository\EloquentStockRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class StockServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(StockFactory::class, StockFactoryImpl::class);
        $this->app->bind(StockService::class, StockServiceImpl::class);
        $this->app->bind(StockRepository::class, EloquentStockRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
