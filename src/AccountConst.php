<?php


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

    const EVENTS = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
        self::SOCIALITE,
        self::RESPONSE,
    ];

    const SCENE = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
    ];
}
