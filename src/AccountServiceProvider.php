<?php

namespace Cblink\UserAccount;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Cblink\UserAccount\Events\UserActionEvent;

class AccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Account::class, function () {
            return new Account();
        });

        $this->mergeConfigFrom(
            \dirname(__DIR__) . '/config/account.php',
            'account'
        );
    }

    public function boot()
    {
        $this->app->booted(function ($app) {
            $account = app(UserActionEvent::class);
            event($account);
        });

        Route::group(config('account.route', []), function () {
            $this->loadRoutesFrom(\dirname(__DIR__) . '/routers/account.php');
        });

        $this->publishes([
            \dirname(__DIR__) . '/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            \dirname(__DIR__) . '/config/account.php' => config_path('account.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(\dirname(__DIR__) . '/migrations/');
        }
    }
}
