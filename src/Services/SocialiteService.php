<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Services;

use Cblink\UserAccount\AccountError;
use Cblink\UserAccount\AccountException;
use Cblink\UserAccount\Models\UserOauth;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService
{
    /**
     * 登陆用户
     *
     * @param $platform
     * @return UserOauth|Model
     */
    public function getOAuthUser($platform)
    {
        try {
            $user = Socialite::driver($platform)->stateless()->user();
        } catch (\Exception $exception) {
            throw new AccountException(AccountError::ERR_CAPTCHA_VERIFY_FAIL);
        }

        $userId = $this->getUserId($user);

        // 判断用户是否已经注册
        $oauthUser = UserOauth::query()->where('platform_id', $userId)->first();

        // 未注册先进行注册
        if (!$oauthUser) {
            $oauthUser = UserOauth::registerBySocialite($platform, $userId, $user);
        }

        return $oauthUser;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getUserId($user)
    {
        return $user->getId();
    }
}
