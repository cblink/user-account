<?php

namespace Tests\Listeners;

use Cblink\UserAccount\Events\UserActionEvent;
use Cblink\UserAccount\Models\UserAccount;
use Cblink\UserAccount\Models\UserOauth;
use Illuminate\Support\Str;

/**
 * Class UserLogin
 * @package Tests\Listeners
 */
class UserLogin
{

    public function handle(UserActionEvent $event)
    {
        $event->account->login(function(UserAccount $account, $userOauth){
            // 与系统用户进行绑定
            // ...

            // 返回登陆的token云云
            // ...

            /**
             * @var UserOauth|null $userOauth
             */

            return ['type' => 'login'];
        });
    }
}