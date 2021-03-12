<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Traits;

use Cblink\UserAccount\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

/**
 * Trait UserAccountTrait
 * @package Cblink\UserAccount\Traits
 */
trait UserAccountTrait
{

    /**
     * @param $mobile
     * @return UserAccount|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function findByMobile($mobile)
    {
        return UserAccount::query()->where([
            'account' => $mobile,
            'type' => UserAccount::TYPE_MOBILE
        ])->first();
    }

    /**
     * @param $account
     * @return int
     */
    public static function getType($account)
    {
        return (bool) filter_var($account, FILTER_VALIDATE_EMAIL) ?
            UserAccount::TYPE_EMAIL : UserAccount::TYPE_MOBILE;
    }

    /**
     * 验证密码
     *
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
