<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Traits;

use Carbon\Carbon;
use Cblink\UserAccount\Models\UserOauth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Laravel\Socialite\AbstractUser;

trait UserOauthTrait
{
    /**
     * 获取绑定码
     *
     * @param int $expiredTime
     * @return string
     */
    public function getBindCode($expiredTime = 3600)
    {
        return encrypt(serialize([$this->id, time() + $expiredTime]));
    }

    /**
     * 通过绑定码查询绑定的用户
     *
     * @param $bindCode
     * @return static|null
     * @throws \Throwable
     */
    public static function findByBindCode($bindCode)
    {
        if (!$bindCode) {
            return null;
        }

        list($id, $expiredTime) = unserialize(decrypt($bindCode));

        // 过期了
        throw_if($expiredTime < time(), InvalidArgumentException::class);

        return static::query()->find($id);
    }

    /**
     * 注册账户
     *
     * @param $platform
     * @param $userId
     * @param AbstractUser $user
     * @return UserOauth|Model
     */
    public static function registerBySocialite($platform, $userId, AbstractUser $user)
    {
        return UserOauth::query()->create([
            'app_id' => config(sprintf('services.%s.client_id', $platform), ''),
            'platform' => $platform,
            'platform_id' => $userId,
            'access_token' => $user->token ?? '',
            'refresh_token' => $user->refreshToken ?? '',
            'expired_at' => Carbon::createFromTimestamp(time() + ($user->expiresIn ?? 0)),
            'status' => UserOauth::STATUS_BIND,
            'name' => $user->getNickname(),
            'avatar' => $user->getAvatar(),
        ]);
    }

    /**
     * 更新用户的信息
     *
     * @param AbstractUser $user
     */
    public function updateBySocialite(AbstractUser $user)
    {
        $this->update([
            'access_token' => $user->token ?? '',
            'refresh_token' => $user->refreshToken ?? '',
            'expired_at' => Carbon::createFromTimestamp(time() + ($user->expiresIn ?? 0)),
            'status' => UserOauth::STATUS_BIND,
        ]);
    }
}
