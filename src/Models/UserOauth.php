<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Models;

use Cblink\UserAccount\Traits\UserOauthTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Cblink\UserAccount\Models\UserOauth
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $platform 应用类型
 * @property string $platform_id 第三方账号ID
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $expired_at
 * @property int $status 授权状态
 * @property string $name 用户名
 * @property string|null $avatar 头像
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Cblink\UserAccount\Models\UserOauthOriginal|null $original
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauth whereUserId($value)
 * @mixin \Eloquent
 */
class UserOauth extends Model
{
    use UserOauthTrait;

    protected $guarded = [];

    const STATUS_BIND = 1;
    const STATUS_UNBIND = 2;

    const STATUS = [
        self::STATUS_BIND => '已授权',
        self::STATUS_UNBIND => '取消授权',
    ];
}
