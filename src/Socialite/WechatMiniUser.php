<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Socialite;

use Illuminate\Support\Arr;
use Laravel\Socialite\AbstractUser;

/**
 * Class WechatMiniUser
 * @package Cblink\UserAccount\Socialite
 */
class WechatMiniUser extends AbstractUser
{
    public function __construct($data, $sessionKey = null)
    {
        $this->setRaw($data);
        $this->map([
            'id' => Arr::get($data, 'openid'),
            'nickname' => Arr::get($data, 'nickName'),
            'name' => Arr::get($data, 'nickName'),
            'email' => null,
            'avatar' => Arr::get($data, 'avatarUrl'),
            'token' => $sessionKey,
        ]);
    }
}
