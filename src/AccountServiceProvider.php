<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount;

use Cblink\UserAccount\Events\UserActionEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        $this->bootedEvent();
        $this->bootRoutes();
        $this->published();
        $this->loadFileToMigrate();
    }

    public function bootedEvent()
    {
        $this->app->booted(function ($app) {
            $account = app(UserActionEvent::class);
            event($account);
        });
    }

    public function bootRoutes()
    {
        if (config('account.route.open', true)) {
            Route::group(config('account.route', []), function () {
                $routeFile = base_path('routes/account.php');

                $loadFile = file_exists($routeFile) ?
                    $routeFile :
                    \dirname(__DIR__) . '/routers/account.php';

                $this->loadRoutesFrom($loadFile);
            });
        }
    }

    public function published()
    {
        $this->publishes([
            \dirname(__DIR__) . '/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            \dirname(__DIR__) . '/config/account.php' => config_path('account.php'),
        ], 'config');
    }

    public function loadFileToMigrate()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(\dirname(__DIR__) . '/migrations/');
        }
    }
}
