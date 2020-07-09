<?php


namespace Cblink\UserAccount\Events;

class SendSms
{
    public $platform;
    public $countryNumber;
    public $mobile;
    public $keyId;
    public $randCode;

    public function __construct($mobile, $countryNumber, $platform, $randCode, $keyId)
    {
        $this->mobile = $mobile;
        $this->countryNumber = $countryNumber;
        $this->platform = $platform;
        $this->randCode = $randCode;
        $this->keyId = $keyId;
    }
}
