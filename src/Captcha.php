<?php


namespace Cblink\UserAccount;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Cache;

/**
 * Class Captcha
 * @package Cblink\UserAccount
 */
class Captcha
{
    /**
     * 生成验证码
     *
     * @param $platform
     * @param $account
     * @param int $len
     * @param int $expiredTime
     * @return array
     */
    public function generate($platform, $account, $len = 6, $expiredTime = 600)
    {
        $randCode = $this->getRandCode(config('account.captcha.num', $len));

        $keyId = md5(Uuid::uuid4()->toString());

        Cache::put($this->getCacheKey($platform, $account, $keyId), $randCode, config('account.captcha.expired_time', $expiredTime));

        return [$keyId, (int) $randCode];
    }

    /**
     * 验证验证码
     *
     * @param $platform
     * @param $account
     * @param $keyId
     * @param $randCode
     * @return bool
     */
    public function verify($platform, $account, $randCode, $keyId)
    {
        if (!Cache::has($this->getCacheKey($platform, $account, $keyId))) {
            return false;
        }

        return Cache::get($this->getCacheKey($platform, $account, $keyId)) == $randCode;
    }

    /**
     * @param $platform
     * @param $account
     * @param $keyId
     * @return string
     */
    protected function getCacheKey($platform, $account, $keyId)
    {
        return sprintf("%s-%s-%s", $platform, $account, $keyId);
    }

    /**
     * @param int $num
     * @return string
     */
    public function getRandCode($num = 6)
    {
        $randCode = mt_rand(0, (int) str_pad("", $num, 9));

        return str_pad($randCode, $num, '0', STR_PAD_LEFT);
    }
}
