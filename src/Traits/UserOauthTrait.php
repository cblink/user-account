<?php


namespace Cblink\UserAccount\Traits;

use Carbon\Carbon;
use Laravel\Socialite\AbstractUser;
use Illuminate\Database\Eloquent\Model;
use Cblink\UserAccount\Models\UserOauth;

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
     */
    public static function findByBindCode($bindCode)
    {
        try {
            list($id, $expiredTime) = unserialize(decrypt($bindCode));

            // 过期了
            if ($expiredTime < time()) {
                throw new \InvalidArgumentException();
            }

        } catch (\Exception $exception) {
            return null;
        }

        return static::query()->findOrFail($id);
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
        $oauthUser = UserOauth::query()->create([
            'platform' => $platform,
            'platform_id' => $userId,
            'access_token' => $user->token,
            'refresh_token' => $user->refreshToken,
            'expired_at' => Carbon::createFromTimestamp(time() + $user->expiresIn),
            'status' => UserOauth::STATUS_NORMAL,
            'name' => $user->getName(),
            'avatar' => $user->getAvatar(),
        ]);

        $oauthUser->original()->create([
            'platform_original' => $user->getRaw()
        ]);

        return $oauthUser;
    }
}
