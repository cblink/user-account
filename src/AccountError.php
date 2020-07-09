<?php


namespace Cblink\UserAccount;

class AccountError
{
    const ERR_UNKNOWN = 99999;
    const ERR_CAPTCHA_VERIFY_FAIL = 10000;

    const PLAT = [
        self::ERR_CAPTCHA_VERIFY_FAIL => '验证码验证失败',
        self::ERR_UNKNOWN => '未知错误',
    ];
}
