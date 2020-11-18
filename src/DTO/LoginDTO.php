<?php

namespace Cblink\UserAccount\DTO;

use Cblink\DTO\DTO;

/**
 * Class LoginDTO
 * @package Cblink\UserAccount\DTO
 * @property-read string $account               账号
 * @property-read string|null $password         密码
 * @property-read integer $captcha              验证码
 * @property-read integer $captcha_key_id       验证码标识
 * @property-read string|null $bind_code        绑定码
 * @property-read string|null $platform         平台标识
 */
class LoginDTO extends DTO
{
    public function rules(): array
    {
        return [
            'account' => ['required'],
            'password' => ['nullable', 'string', 'min:6', 'max:32'],

            'platform' => ['nullable', 'string'],

            'captcha' => ['required_without:password', 'integer'],
            'captcha_key_id' => ['required_with:rand_code'],

            'bind_code' => ['nullable', 'string'],
        ];
    }
}
