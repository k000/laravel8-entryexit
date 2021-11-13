<?php

namespace App\Providers;

use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Logic\Service\EntryExitDeleteLogic;
use App\Domain\Logic\Service\EntryExitInitializeLogic;
use App\Domain\Logic\Service\EntryExitUpdateLogic;
use App\Domain\Logic\Service\Impl\EntryExitCreationLogicImpl;
use App\Domain\Logic\Service\Impl\EntryExitDeleteLogicImpl;
use App\Domain\Logic\Service\Impl\EntryExitInitializeLogicImpl;
use App\Domain\Logic\Service\Impl\EntryExitUpdateLogicImpl;
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
        // 初期化ロジック
        $this->app->bind(EntryExitInitializeLogic::class, EntryExitInitializeLogicImpl::class);
        // 更新ロジック
        $this->app->bind(EntryExitUpdateLogic::class, EntryExitUpdateLogicImpl::class);
        // 削除ロジック
        $this->app->bind(EntryExitDeleteLogic::class, EntryExitDeleteLogicImpl::class);
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
