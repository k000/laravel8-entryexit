<?php

namespace App\Providers;

use App\Domain\Service\EntryExitComboboxService;
use App\Domain\Service\Impl\EntryExitComboboxServiceImpl;
use Illuminate\Support\ServiceProvider;

class ComboboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EntryExitComboboxService::class,EntryExitComboboxServiceImpl::class);
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
