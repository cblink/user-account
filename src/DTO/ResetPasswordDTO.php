<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\DTO;

use Cblink\DTO\DTO;

/**
 * Class ResetPasswordDTO
 * @package Cblink\UserAccount\DTO
 * @property-read string $account               账号
 * @property-read string $password              密码
 * @property-read integer $captcha              验证码
 * @property-read integer $captcha_key_id       验证码标识
 * @property-read string|null $platform         平台标识
 */
class ResetPasswordDTO extends DTO
{
    public function rules(): array
    {
        return [
            'account' => ['required'],
            'password' => ['required', 'string', 'min:6', 'max:32'],

            'platform' => ['nullable', 'string'],

            'captcha' => ['required', 'integer'],
            'captcha_key_id' => ['required', 'string'],
        ];
    }
}
