<?php

namespace Cblink\UserAccount\Socialite;

use Illuminate\Support\Arr;
use Laravel\Socialite\AbstractUser;

/**
 * Class WechatMiniUser
 * @package Cblink\UserAccount\Socialite
 */
class WechatMiniUser extends AbstractUser
{
    public function __construct($data)
    {
        $this->map([
            'id' => Arr::get($data, 'openid'),
            'nickname' => null,
            'name' => null,
            'email' => null,
            'avatar' => null,
            'user' => $data
        ]);
    }
}