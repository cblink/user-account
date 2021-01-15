<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Services;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\AccountError;
use Cblink\UserAccount\AccountException;
use Cblink\UserAccount\Captcha;
use Cblink\UserAccount\DTO\LoginDTO;
use Cblink\UserAccount\DTO\ResetPasswordDTO;
use Cblink\UserAccount\Models\UserAccount;
use Cblink\UserAccount\Models\UserOauth;

class AccountService
{
    /**
     * @var Captcha
     */
    protected $captcha;

    public function __construct(Captcha $captcha)
    {
        $this->captcha = $captcha;
    }

    /**
     * @param LoginDTO $dto
     * @return mixed
     * @throws \Throwable
     */
    public function loginUser(LoginDTO $dto)
    {
        $scene = $this->getScene($dto->account);

        throw_disabled_feature($scene);

        $this->verifyCaptcha($scene, $dto->account, $dto->captcha, $dto->captcha_key_id);

        $account = $this->loginOrRegister($dto->account, $dto->password);

        // 查询第三方绑定信息
        $userOauth = UserOauth::findByBindCode($dto->bind_code);

        return [$scene, [$account, $userOauth, $dto]];
    }

    /**
     * 登陆或注册账号
     *
     * @param $account
     * @param $password
     * @param bool $created
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function loginOrRegister($account, $password, bool $created = true)
    {
        $userAccount = UserAccount::query()->where('account', $account)->first();

        // 如果账号存在，但是密码验证失败，则提示错误
        if (!is_null($userAccount) && !empty($password) && !$userAccount->checkPassword($password)) {
            throw new AccountException(AccountError::ERR_CAPTCHA_VERIFY_FAIL);
        }

        // 如果账号不存在，则注册用户
        if (!$userAccount && $created) {
            $userAccount = UserAccount::query()
                ->create([
                    'account' => $account,
                    'type' => $this->getType($account),
                    'password' => $password,
                ]);
        }

        return $userAccount;
    }

    /**
     * @param $account
     * @return int
     */
    public function getType($account): int
    {
        return (bool) filter_var($account, FILTER_VALIDATE_EMAIL) ?
            UserAccount::TYPE_EMAIL : UserAccount::TYPE_MOBILE;
    }

    /**
     * @param $account
     * @return string
     */
    public function getScene($account): string
    {
        $account = UserAccount::query()->where('account', $account)->first();

        return $account ? AccountConst::LOGIN : AccountConst::REGISTER;
    }

    /**
     * @param ResetPasswordDTO $dto
     * @return mixed
     */
    public function resetPassword(ResetPasswordDTO $dto)
    {
        $userAccount = UserAccount::query()
            ->where('account', $dto->account)
            ->first();

        $this->verifyCaptcha(AccountConst::RESET, $dto->account, $dto->captcha, $dto->captcha_key_id);

        // 修改密码
        $userAccount->password = $dto->password;
        $userAccount->save();

        return $userAccount;
    }


    /**
     * @param $platform
     * @param $account
     * @param $captcha
     * @param $captcha_key_id
     */
    public function verifyCaptcha($platform, $account, $captcha, $captcha_key_id)
    {
        // 如果有传入验证码，则进行验证
        if ($captcha) {
            // 验证验证码
            if (!$this->captcha->verify(...func_get_args())) {
                throw new AccountException(AccountError::ERR_CAPTCHA_VERIFY_FAIL);
            }
        }
    }
}
