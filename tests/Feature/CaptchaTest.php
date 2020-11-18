<?php

namespace Tests\Feature;

use Cblink\UserAccount\AccountConst;
use Illuminate\Support\Facades\Event;
use Tests\BaseTestCase;

/**
 * Class CaptchaTest
 * @package Tests\Feature
 */
class CaptchaTest extends BaseTestCase
{

    public function testSendMail()
    {
        Event::fake();

        $response = $this->post('captcha/mail/send', [
            'mail' => 'test@cblink.net',
            'scene' => AccountConst::LOGIN,
        ]);

        $response->assertJsonStructure([
            'data' => ['key']
        ]);
    }

    public function testSendSms()
    {
        Event::fake();

        $response = $this->post('captcha/sms/send', [
            'mobile' => '13100000000',
            'country_number' => '86',
            'scene' => AccountConst::LOGIN,
        ]);

        $response->assertJsonStructure([
            'data' => ['key']
        ]);
    }

}