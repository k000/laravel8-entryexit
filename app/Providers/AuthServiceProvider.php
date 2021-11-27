<?php

namespace App\Providers;

// 残してます
use App\Domain\Model\Entity\EntryExitSlip;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        \App\Models\EntryExitSlip::class => App\Policies\EntryExitSlipPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ゲートを使う場合
        /*
        Gate::define('update-slip', function (User $user, EntryExitSlip $slip) {
            return $user->id == $slip->getUpdateUser();
        });
        */
        
    }
}
