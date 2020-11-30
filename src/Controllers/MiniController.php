<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\AccountError;
use Cblink\UserAccount\AccountException;
use Cblink\UserAccount\DTO\WechatMiniLoginDTO;
use Cblink\UserAccount\Models\UserOauth;
use Cblink\UserAccount\Requests\GetMiniMobileRequest;
use Cblink\UserAccount\Services\AccountService;
use Cblink\UserAccount\Services\WechatMiniService;
use Illuminate\Http\Request;

/**
 * Class MiniController
 * @package Cblink\UserAccount\Controllers
 */
class MiniController extends BaseController
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
        return $this->callbackEvent([$oauthUser], AccountConst::SOCIALITE);
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

        try {
            $data = $this->service->decodeData(
                $request->get('encryptedData'),
                $request->get('iv'),
                $oauthUser->access_token
            );
        }catch (\Exception $exception) {
            throw new AccountException(AccountError::ERR_MINI_MOBILE_ERROR);
        }

        // 解密失败
        throw_if(is_null($data), AccountException::class, AccountError::ERR_WECHAT_MINI_DECRYPT_FAIL);

        $account = $data['purePhoneNumber'];

        // 注册或登陆手机号
        $userAccount = $service->loginOrRegister($account, null);

        // 已注册了返回绑定的user_id
        return $this->callbackEvent([$userAccount, $oauthUser], $service->getScene($account));
    }
}