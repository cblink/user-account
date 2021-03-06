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
use Cblink\UserAccount\Models\UserOauth;

class UserSocialiteLogin
{
    public function handle(UserActionEvent $event)
    {
        $event->account->socialite(function (UserOauth $oauthUser) {

            /**
             * 这里可以处理第三方登陆后的逻辑
             */

            // 验证是否绑定用户
            // ...

            // 绑定用户
            // ...

            // 返回登陆凭证
            // ..

            return ['type' => 'socialite'];
        });
    }
}
