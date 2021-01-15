<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Feature;

use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\Captcha;
use Tests\BaseTestCase;

/**
 * Class AccountTest
 * @package Tests\Feature
 */
class AccountTest extends BaseTestCase
{
    public function testLoginOrRegister()
    {
        $account = 'test@cblink.net';

        $captcha = app(Captcha::class);

        [$keyId, $randCode] = $captcha->generate(AccountConst::REGISTER, $account);

        $response = $this->post('account/login', [
            'account' => $account,
            'captcha' => $randCode,
            'captcha_key_id' => $keyId
        ]);

        $response->assertJson([
            'type' => AccountConst::REGISTER
        ]);
    }
}
