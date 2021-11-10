<?php

namespace App\Providers;

use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Logic\Service\Impl\EntryExitCreationLogicImpl;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Domain\Repository\EntryExitSlipRepository;
use App\Domain\Service\EntryExitService;
use App\Domain\Service\Impl\EntryExitServiceImpl;
use App\Infrastructure\Repository\EloquentEntryExitDetailRepositoryImpl;
use App\Infrastructure\Repository\EloquentEntryExitSlipRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class EntryExitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EntryExitService::class, EntryExitServiceImpl::class);
        // 新規作成ロジック
        $this->app->bind(EntryExitCreationLogic::class, EntryExitCreationLogicImpl::class);
        // リポジトリ
        $this->app->bind(EntryExitSlipRepository::class, EloquentEntryExitSlipRepositoryImpl::class);
        $this->app->bind(EntryExitDetailRepository::class, EloquentEntryExitDetailRepositoryImpl::class);
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
