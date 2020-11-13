<?php


namespace Cblink\UserAccount\Services;

use Carbon\Carbon;
use Cblink\UserAccount\Models\UserOauth;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\AbstractUser;
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
        $user = Socialite::driver($platform)->stateless()->user();

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
