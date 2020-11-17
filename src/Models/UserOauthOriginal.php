<?php

namespace Cblink\UserAccount\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Cblink\UserAccount\Models\UserOauthOriginal
 *
 * @property int $user_oauth_id
 * @property array $platform_original 元数据
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauthOriginal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauthOriginal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cblink\UserAccount\Models\UserOauthOriginal query()
 * @mixin \Eloquent
 */
class UserOauthOriginal extends Model
{
    protected $table = 'user_oauth_original';

    protected $primaryKey = 'user_oauth_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'platform_original' => 'json'
    ];
}
