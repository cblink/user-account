<?php


namespace Cblink\UserAccount;

class AccountError
{
    const ERR_UNKNOWN = 99999;
    const ERR_CAPTCHA_VERIFY_FAIL = 10000;
    const ERR_BIND_CODE_ERROR = 10001;
    const ERR_MINI_MOBILE_ERROR = 10002;
    const ERR_SOCIALITE_USER_FAIL = 10003;

    const PLAT = [
        self::ERR_CAPTCHA_VERIFY_FAIL => '验证码验证失败',
        self::ERR_BIND_CODE_ERROR => '绑定码错误',
        self::ERR_MINI_MOBILE_ERROR => '手机号校验失败',
        self::ERR_UNKNOWN => '未知错误',
        self::ERR_SOCIALITE_USER_FAIL => '用户信息获取失败',
    ];
}
