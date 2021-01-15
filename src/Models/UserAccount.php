<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Models;

use Cblink\UserAccount\Traits\UserAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Cblink\UserAccount\Models\UserAccount
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $account 登陆的账号
 * @property string|null $password 密码
 * @property int $type 账号类型
 * @property int $status 账号状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserAccount whereUserId($value)
 * @mixin \Eloquent
 */
class UserAccount extends Model
{
    use UserAccountTrait;

    protected $guarded = [];

    // 登陆类型
    const LOGIN_TYPE_PASSWORD = 1;
    const LOGIN_TYPE_CODE = 2;

    const LOGIN_TYPE = [
        self::LOGIN_TYPE_PASSWORD => '账号密码登陆',
        self::LOGIN_TYPE_CODE => '验证码登陆',
    ];

    // 账号类型
    const TYPE_MOBILE = 1;
    const TYPE_EMAIL = 2;

    const TYPE = [
        self::TYPE_MOBILE => '手机号',
        self::TYPE_EMAIL => '邮箱',
    ];


    /**
     * 状态
     */
    const STATUS_NORMAL = 1;
    const STATUS_DISABLE = 10;

    const STATUS = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_DISABLE => '禁用',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = empty($password) ? null : Hash::make($password);
    }
}
