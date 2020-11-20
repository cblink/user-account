<h1 align="center"> 社会化登陆/用户登录组件 </h1>


## 安装

```shell
$ composer require cblink/user-account -vvv
```

## 配置
`services.php`

```php
    return [
        // ...
        // ... 

        // 其他第三方登陆
        // @see https://socialiteproviders.netlify.com/

        // 小程序登陆
        'wechat_mini' => [
            'appid' => 'xxx',
            'secret' => 'xxxxxxxxxxx',
        ]
    ];
```

`account.php`

```php
<?php

return [
     // 路由前缀
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
```

## 内置接口

- 用户登录/注册(手机号/邮箱方式)
- 重置密码(手机号/邮箱方式)
- 第三方登陆
    - 获取授权url
    - 跳转至第三方地址(支持的方式：https://socialiteproviders.com/)
    - 获取用户信息
    - 小程序登陆
- 发送验证码

## 事件说明

你只需要实现以下的事件，你就可以愉快的使用这个包了。

| 事件 | 说明 | 
| - | - |
|Cblink\UserAccount\Events\SendMail | 发送邮件 |
|Cblink\UserAccount\Events\SendSms | 发送短信 |
|Cblink\UserAccount\Events\UserActionEvent | 接口基础返回实现 |


## TODO

- 待继续补充