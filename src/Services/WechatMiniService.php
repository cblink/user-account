<?php

namespace Cblink\UserAccount\Services;

use Cblink\UserAccount\DTO\WechatMiniLoginDTO;
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

    /**
     * @param WechatMiniLoginDTO $dto
     * @return UserOauth|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function login(WechatMiniLoginDTO $dto)
    {
        $data = $this->code2Session($dto->code);

        // 判断用户是否已经注册
        $oauthUser = UserOauth::query()
            ->where('platform_id', $this->getUserId($data))
            ->first();

        // 未注册先进行注册
        if (!$oauthUser) {
            $oauthUser = UserOauth::registerBySocialite(
                self::WECHAT_MINI,
                $this->getUserId($data),
                $this->getUserInfo($dto, $data)
            );
        } else {
            $oauthUser->updateBySocialite($this->getUserInfo($dto, $data));
        }

        return $oauthUser;
    }

    /**
     * @param WechatMiniLoginDTO $dto
     * @param $data
     * @return WechatMiniUser
     */
    public function getUserInfo(WechatMiniLoginDTO $dto, $data)
    {
        $sessionKey = $data['session_key'];

        if ($dto->iv && $dto->encryptedData) {
            $data = $this->decodeData(
                $dto->encryptedData,
                $dto->iv,
                $sessionKey
            );
        }

        return new WechatMiniUser($data, $sessionKey);
    }

    /**
     * @param $data
     * @param $iv
     * @param $sessionKey
     * @return mixed
     */
    public function decodeData($data, $iv, $sessionKey)
    {
        return json_decode(openssl_decrypt(
            base64_decode($data),
            'AES-128-CBC',
            base64_decode($sessionKey),
            OPENSSL_PKCS1_PADDING,
            base64_decode($iv)
        ), true);
    }

    /**
     * @param $data
     * @return array|\ArrayAccess|mixed
     */
    public function getUserId($data)
    {
        return Arr::get($data, 'openid');
    }

    /**
     * @param $code
     * @return array
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

        return $data;
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