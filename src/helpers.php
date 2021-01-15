<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\AccountError;
use Cblink\UserAccount\AccountException;

if (!function_exists('callbackEvent')) {
    /**
     * 调用事件里的回调
     *
     * @param array $params
     * @param string $name
     * @return mixed
     * @throws \Throwable
     */
    function callbackEvent(array $params = [], $name = AccountConst::RESPONSE)
    {
        $account = app(Account::class);

        throw_unless(isset($account->{$name}), AccountException::class, AccountError::ERR_EVENT_NOT_DEFINED);

        return call_user_func_array($account->{$name}, $params);
    }
}

if (!function_exists('throw_disabled_feature')) {
    /**
     * @param $feature
     * @throws Throwable
     */
    function throw_disabled_feature($feature)
    {
        throw_if(
            in_array($feature, config('account.disabled', [])),
            AccountException::class,
            AccountError::ERR_FEATURE_IS_DISABLED
        );
    }
}

if (!function_exists('throw_disabled_feature')) {
    /**
     * @param $feature
     * @throws Throwable
     */
    function throw_disabled_feature($feature)
    {
        throw_if(
            in_array($feature, config('account.disabled', [])),
            AccountException::class,
            AccountError::ERR_FEATURE_IS_DISABLED
        );
    }
}
