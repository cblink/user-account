<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Captcha;
use Cblink\UserAccount\Events\SendSms;
use Cblink\UserAccount\Events\SendMail;
use Cblink\UserAccount\Requests\SendSmsRequest;
use Cblink\UserAccount\Requests\SendMailRequest;

/**
 * Class CaptchaController
 * @package App\Http\Controllers\Common
 */
class CaptchaController extends BaseController
{
    /**
     * 发送邮件
     *
     * @param SendMailRequest $request
     * @param Captcha $captcha
     * @return array
     */
    public function sendMail(SendMailRequest $request, Captcha $captcha)
    {
        list($keyId, $randCode) = $captcha->generate($request->input('platform'), $request->input('mail'));

        event(new SendMail(
            $request->get('mail'),
            $request->get('platform'),
            $randCode,
            $keyId
        ));

        $params = ['key' => $keyId];

        return $this->callbackEvent([$params]);
    }

    /**
     * @param SendSmsRequest $request
     * @param Captcha $captcha
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function sendSms(SendSmsRequest $request, Captcha $captcha)
    {
        $account = $request->input('country_number') . $request->input('mobile');

        list($keyId, $randCode) = $captcha->generate($request->input('platform'), $account);

        event(new SendSms(
            $request->input('mobile'),
            $request->input('country_number'),
            $request->input('platform'),
            $randCode,
            $keyId
        ));

        $params = ['key' => $keyId];

        return $this->callbackEvent([$params]);
    }
}
