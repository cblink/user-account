<?php

namespace Cblink\UserAccount\DTO;

use Cblink\DTO\DTO;

/**
 * Class WechatMiniLoginDTO
 * @package Cblink\UserAccount\DTO
 * @property-read string $code              小程序code
 * @property-read string $encryptedData     userinfo中的encryptedData
 * @property-read string $iv                iv
 */
class WechatMiniLoginDTO extends DTO
{

    public function rules(): array
    {
        return [
            'platform' => ['nullable', 'string'],
            'code' => ['required', 'string'],
            'encryptedData' => ['nullable', 'string'],
            'iv' => ['nullable', 'string'],
        ];
    }
}