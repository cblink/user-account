<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;
use Cblink\UserAccount\Services\SocialiteService;

/**
 * Class SocialiteController
 * @package App\Http\Controllers\Common
 */
class SocialiteController extends Controller
{
    /**
     * @param $platform
     * @return array
     */
    public function url($platform)
    {
        $redirectUrl = route('socialite.redirect', ['platform' => $platform]);

        $params = ['url' => $redirectUrl];

        return call_user_func_array(app(Account::class)->response, [$params]);
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
        return call_user_func(app(Account::class)->socialite, $oauthUser);
    }
}
