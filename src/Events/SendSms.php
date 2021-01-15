<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Events;

/**
 * Class SendSms
 * @package Cblink\UserAccount\Events
 */
class SendSms
{
    /**
     * @var string
     */
    public $scene;

    /**
     * @var string
     */
    public $countryNumber;

    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $keyId;

    /**
     * @var string
     */
    public $randCode;

    public $platform;

    public function __construct($mobile, $countryNumber, $scene, $randCode, $keyId, $platform)
    {
        $this->mobile = $mobile;
        $this->countryNumber = $countryNumber;
        $this->scene = $scene;
        $this->randCode = $randCode;
        $this->keyId = $keyId;
        $this->platform = $platform;
    }
}
