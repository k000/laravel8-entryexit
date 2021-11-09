<?php

namespace App\Providers;

use App\Domain\Repository\ItemRepository;
use App\Domain\Service\Impl\ItemServiceImpl;
use App\Domain\Service\ItemService;
use App\Infrastructure\Repository\EloquentItemRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
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
        $this->app->bind(ItemService::class,ItemServiceImpl::class);
        $this->app->bind(ItemRepository::class, EloquentItemRepositoryImpl::class);
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
