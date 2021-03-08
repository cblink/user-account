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
use Cblink\UserAccount\Services\SocialiteService;
use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialiteController
 * @package App\Http\Controllers\Common
 */
class SocialiteController extends Controller
{
    /**
     * @param $platform
     * @return array
     * @throws \Throwable
     */
    public function url($platform)
    {
        $redirectUrl = route('socialite.redirect', ['platform' => $platform]);

        $params = ['url' => $redirectUrl];

        return callbackEvent([$params]);
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
     * @throws \Throwable
     */
    public function user($platform, SocialiteService $service)
    {
        [$oauthUser, $user] = $service->getOAuthUser($platform);

        // 已注册了返回绑定的user_id
        return callbackEvent([$oauthUser, $user], AccountConst::SOCIALITE);
    }
}
