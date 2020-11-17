<?php

namespace Tests\Listeners;

use Cblink\UserAccount\Events\UserActionEvent;
use Cblink\UserAccount\Models\UserAccount;

/**
 * Class ResetPassword
 * @package Tests\Listenersß
 */
class ResetPassword
{
    public function handle(UserActionEvent $event)
    {
        $event->account->reset(function(UserAccount $account){

            // 密码修改成功后的处理
            // ...

            return ['type' => 'reset'];
        });
    }
}