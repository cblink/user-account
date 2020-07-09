<?php

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
];