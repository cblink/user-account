<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\AccountConst;
use Laravel\Socialite\Facades\Socialite;
use Cblink\UserAccount\Services\SocialiteService;

/**
 * Class SocialiteController
 * @package App\Http\Controllers\Common
 */
class SocialiteController extends BaseController
{
    /**
     * @param $platform
     * @return array
     */
    public function url($platform)
    {
        $redirectUrl = route('socialite.redirect', ['platform' => $platform]);

        $params = ['url' => $redirectUrl];

        return $this->callbackEvent([$params]);
    }

    /**
     * @param $platform
     * @return mixed
     */
    public function redirect($platform)
    {
        return Socialite::driver($platform)->stateless()->redirect();
    }

    /**
     * @param $platform
     * @param SocialiteService $service
     * @return mixed
     */
    public function user($platform, SocialiteService $service)
    {
        $oauthUser = $service->getOAuthUser($platform);

        // 已注册了返回绑定的user_id
        return $this->callbackEvent([$oauthUser], AccountConst::SOCIALITE);
    }
}
