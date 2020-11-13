<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\Requests\MiniLoginRequest;
use Cblink\UserAccount\Services\WechatMiniService;

/**
 * Class MiniController
 * @package Cblink\UserAccount\Controllers
 */
class MiniController extends BaseController
{
    public function login(MiniLoginRequest $request, WechatMiniService $service)
    {
        $oauthUser = $service->login($request->get('code'));

        // 已注册了返回绑定的user_id
        return call_user_func(app(Account::class)->socialite, $oauthUser);
    }
}