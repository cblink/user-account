<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\DTO\WechatMiniLoginDTO;
use Cblink\UserAccount\Services\WechatMiniService;
use Illuminate\Http\Request;

/**
 * Class MiniController
 * @package Cblink\UserAccount\Controllers
 */
class MiniController extends BaseController
{
    /**
     * @param Request $request
     * @param WechatMiniService $service
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function login(Request $request, WechatMiniService $service)
    {
        $dto = new WechatMiniLoginDTO($request->all());

        $oauthUser = $service->login($dto);

        // 已注册了返回绑定的user_id
        return $this->callbackEvent([$oauthUser], AccountConst::SOCIALITE);
    }
}