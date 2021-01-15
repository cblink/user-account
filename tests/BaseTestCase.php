<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountServiceProvider;
use Cblink\UserAccount\Events\UserActionEvent;
use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase;
use Tests\Listeners\UserSocialiteLogin;
use Tests\Providers\EventServiceProvider;

/**
 * Class BaseTestCase
 * @package Tests
 */
class BaseTestCase extends TestCase
{

    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [AccountServiceProvider::class, EventServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @throws \Throwable
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('cache.default', 'array');

        $configPath = __DIR__ . DIRECTORY_SEPARATOR . 'config/';

        foreach (['services'] as $file) {
            $filePath = file_exists(sprintf('%sdev.%s.php', $configPath, $file)) ?
                sprintf('%sdev.%s.php', $configPath, $file) :
                sprintf('%s%s.php', $configPath, $file);

            throw_unless(file_exists($filePath), \LogicException::class, sprintf('config %s not found', $file));

            $app['config']->set($file, require $filePath);
        }
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(dirname(__DIR__) . '/migrations');
        $this->artisan('migrate')->run();
        /** @var Account $account **/
        $account = $this->app->make(Account::class);

        $this->instance(Account::class, $account);
    }
}
