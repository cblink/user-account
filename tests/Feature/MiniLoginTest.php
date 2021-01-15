<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Feature;

use Cblink\UserAccount\Services\WechatMiniService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\BaseTestCase;

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
