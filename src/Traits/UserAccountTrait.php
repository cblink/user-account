<?php


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
