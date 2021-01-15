<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Cblink\UserAccount\Controllers as Api;
use Illuminate\Support\Facades\Route;

# 账号登陆
Route::prefix('account')->group(function () {
    Route::post('login', [Api\AccountController::class, 'login']);
    Route::post('reset', [Api\AccountController::class, 'resetPassword']);
});

# 社会化登陆
Route::prefix('socialite')->group(function () {
    Route::get('{platform}/url', [Api\SocialiteController::class, 'url']);
    Route::get('{platform}/redirect', [Api\SocialiteController::class, 'redirect'])->name('socialite.redirect');
    Route::get('{platform}/user', [Api\SocialiteController::class, 'user'])->name('socialite.user');
});

# 小程序登陆
Route::prefix('wechat-mini')->group(function () {
    Route::post('login', [Api\MiniController::class, 'login'])->name('wechat.mini.login');
    Route::post('mobile/login', [Api\MiniController::class, 'mobileLogin'])->name('wechat.mini.mobile.login');
});

# 验证码
Route::prefix('captcha')->group(function () {
    Route::post('mail/send', [Api\CaptchaController::class, 'sendMail'])->name('send.mail')->middleware('throttle:10,1');
    Route::post('sms/send', [Api\CaptchaController::class, 'sendSms'])->name('send.sms')->middleware('throttle:3,1');
});
