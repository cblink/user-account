<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Listeners;

use Cblink\UserAccount\Events\UserActionEvent;
use Cblink\UserAccount\Models\UserAccount;
use Cblink\UserAccount\Models\UserOauth;

class UserRegister
{
    public function handle(UserActionEvent $event)
    {
        $event->account->register(function (UserAccount $account, $userOauth) {

            // 与系统用户进行绑定
            // ...

            // 登陆或提示注册成功
            // ...

            /**
             * @var UserOauth|null $userOauth
             */

            return ['type' => 'register'];
        });
    }
}
