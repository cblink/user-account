<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\AccountError;
use Cblink\UserAccount\AccountException;
use Cblink\UserAccount\DTO\WechatMiniLoginDTO;
use Cblink\UserAccount\Models\UserAccount;
use Cblink\UserAccount\Models\UserOauth;
use Cblink\UserAccount\Requests\GetMiniMobileRequest;
use Cblink\UserAccount\Services\AccountService;
use Cblink\UserAccount\Services\WechatMiniService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class MiniController
 * @package Cblink\UserAccount\Controllers
 */
class MiniController extends Controller
{
    protected $service;

    public function __construct(WechatMiniService $service)
    {
        $this->service = $service;
    }

    /**
     * code登陆
     *
     * @param Request $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function login(Request $request)
    {
        $dto = new WechatMiniLoginDTO($request->all());

        $oauthUser = $this->service->login($dto);

        // 已注册了返回绑定的user_id
        return callbackEvent([$oauthUser], AccountConst::SOCIALITE);
    }

    /**
     * 手机号登陆
     *
     * @param GetMiniMobileRequest $request
     * @param AccountService $service
     * @return mixed
     * @throws \Throwable
     */
    public function mobileLogin(GetMiniMobileRequest $request, AccountService $service)
    {
        $oauthUser = UserOauth::findByBindCode($request->get('bind_code'));

        throw_unless($oauthUser, AccountException::class, AccountError::ERR_BIND_CODE_ERROR);

        $data = $this->service->getMobileInfo(
            $request->get('encryptedData'),
            $request->get('iv'),
            $oauthUser->access_token
        );

        [$userAccount, $scene] = $service->loginOrRegister($data['purePhoneNumber']);

        // 已注册了返回绑定的user_id
        return callbackEvent([$userAccount, $oauthUser], $scene);
    }
}
