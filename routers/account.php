<?php

use Illuminate\Support\Facades\Route;
use Cblink\UserAccount\Controllers as Api;

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
Route::prefix('wechat-mini')->group(function(){
    Route::get('login', [Api\MiniController::class, 'login'])->name('wechat.mini.login');
});

# 验证码
Route::prefix('captcha')->group(function () {
    Route::post('mail/send', [Api\CaptchaController::class, 'sendMail'])->middleware('throttle:10,1');
    Route::post('sms/send', [Api\CaptchaController::class, 'sendSms'])->middleware('throttle:3,1');
});
