<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount;

/**
 * Class AccountConst
 * @package Cblink\UserAccount
 */
class AccountConst
{
    const REGISTER = 'register';
    const LOGIN = 'login';
    const RESET = 'reset';
    const SOCIALITE = 'socialite';
    const RESPONSE = 'response';
    const BIND = 'bind';
    const VALIDATE = 'validate';

    /**
     * 事件
     */
    const EVENTS = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
        self::SOCIALITE,
        self::RESPONSE,
    ];

    /**
     * 场景信息
     */
    const SCENE = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
        self::BIND,
        self::VALIDATE,
    ];

    /**
     * 功能
     */
    const FEATURE = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
        self::SOCIALITE,
    ];
}
