<?php

namespace Cblink\UserAccount\Services;

use Cblink\UserAccount\Models\UserOauth;
use Cblink\UserAccount\Socialite\WechatMiniUser;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

/**
 * Class WechatMiniService
 * @package Cblink\UserAccount\Services
 */
class WechatMiniService
{
    const WECHAT_MINI = 'wechat_mini';
    /**
     * @var Client
     */
    protected $httpClient;

    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    public function login($code)
    {
        $user = $this->code2Session($code);

        // 判断用户是否已经注册
        $oauthUser = UserOauth::query()->where('platform_id', $user->getId())->first();

        // 未注册先进行注册
        if (!$oauthUser) {
            $oauthUser = UserOauth::registerBySocialite(self::WECHAT_MINI, $user->getId(), $user);
        }

        return $oauthUser;
    }

    /**
     * @param $user
     * @return array|\ArrayAccess|mixed
     */
    public function getUserId($user)
    {
        return Arr::get($user, 'openid');
    }

    /**
     * @param $code
     * @return WechatMiniUser
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function code2Session($code)
    {
        $response = $this->getHttpClient()->request(
            'GET',
            "https://api.weixin.qq.com/sns/jscode2session",
            [
                'http_errors' => false,
                'verify' => false,
                'query' => $this->getUserFieldByCode($code),
            ]
        );

        $data = json_decode($response->getBody()->getContents(), true);

        $this->throwException($data);

        return new WechatMiniUser($data);
    }

    /**
     * @param $code
     * @return array
     */
    private function getUserFieldByCode($code)
    {
        return [
            'appid' => config(sprintf('services.%s.appid', self::WECHAT_MINI)),
            'secret' => config(sprintf('services.%s.secret', self::WECHAT_MINI)),
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];
    }

    /**
     * @param $data
     * @throws \Throwable
     */
    private function throwException($data)
    {
        throw_unless(
            Arr::get($data, 'errcode') == 0,
            \LogicException::class,
            Arr::get($data, 'errmsg', '未知错误')
        );
    }

    /**
     * @return Client
     */
    private function getHttpClient()
    {
        return $this->httpClient;
    }

}