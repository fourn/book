<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Transfer::class => \App\Policies\TransferPolicy::class,
		 \App\Models\Order::class => \App\Policies\OrderPolicy::class,
		 \App\Models\Book::class => \App\Policies\BookPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        \Horizon::auth(function ($request) {
            // 是否后台超级管理员
            return Admin::user()->isAdministrator();
        });
        //
    }
}
