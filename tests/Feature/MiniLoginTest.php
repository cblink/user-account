<?php

namespace Tests\Feature;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountServiceProvider;
use Cblink\UserAccount\DTO\WechatMiniLoginDTO;
use Cblink\UserAccount\Events\UserActionEvent;
use Cblink\UserAccount\Services\WechatMiniService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\BaseTestCase;
use Tests\Listeners\UserSocialiteLogin;

/**
 * Class MiniLoginTest
 * @package Tests\Feature
 */
class MiniLoginTest extends BaseTestCase
{

    public function testCodeLogin()
    {
        $code = "0937Ghll2qXFY54lG7ol2rguxc07GhlA";

        $openid = 'xxxxxxxxxxxxx';
        $sessionKey = Str::random(16);

        $service = \Mockery::mock(WechatMiniService::class)->makePartial();
        $service->allows()->code2Session($code)->andReturn([
            'openid' => $openid,
            'session_key' => $sessionKey
        ]);

        $this->app->instance(WechatMiniService::class, $service);

        $response = $this->post('/wechat-mini/login', [
            'code' => $code
        ]);

        $response->assertJson([
            'type' => 'socialite'
        ]);
    }


}