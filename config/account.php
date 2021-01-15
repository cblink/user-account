<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    'route' => [
        'prefix' => '',
    ],
    // 验证码相关
    'captcha' => [
        // 验证码位数
        'number' => 6,
        // 验证码有效期，单位s
        'expired_time' => 600,
    ],

    // 需要关闭的功能，详见：\Cblink\UserAccount\AccountConst::FEATURE
    'disabled' => [],
];
