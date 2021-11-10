<?php

namespace App\Providers;

use App\Domain\Repository\NumberingRepository;
use App\Infrastructure\Repository\NumberingRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 採番処理
        $this->app->bind(NumberingRepository::class,NumberingRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
