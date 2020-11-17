<?php


namespace Tests\Listeners;


use Cblink\UserAccount\Events\UserActionEvent;
use Cblink\UserAccount\Models\UserOauth;

class UserSocialiteLogin
{
    public function handle(UserActionEvent $event)
    {
        $event->account->socialite(function(UserOauth $oauthUser){

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