<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Cblink\UserAccount\Events\UserActionEvent::class => [
            \Tests\Listeners\UserLogin::class,
            \Tests\Listeners\UserRegister::class,
            \Tests\Listeners\CommonResponse::class,
            \Tests\Listeners\UserSocialiteLogin::class,
            \Tests\Listeners\ResetPassword::class,
            \Tests\Listeners\UserRegister::class,
        ],
    ];
}
