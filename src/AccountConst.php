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

    const EVENTS = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
    ];
}
