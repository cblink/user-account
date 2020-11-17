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
        $this->setRaw($data);
        $this->map([
            'id' => Arr::get($data, 'openid'),
            'nickname' => Arr::get($data, 'nickName'),
            'name' => Arr::get($data, 'nickName'),
            'email' => null,
            'avatar' => Arr::get($data, 'avatarUrl'),
        ]);
    }
}