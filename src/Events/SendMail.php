<?php


namespace Cblink\UserAccount\Events;

/**
 * Class SendMail
 * @package Cblink\UserAccount\Events
 */
class SendMail
{
    /**
     * @var string
     */
    public $mail;

    /**
     * @var string
     */
    public $scene;

    /**
     * @var string
     */
    public $randCode;

    /**
     * @var string
     */
    public $keyId;

    /**
     * @var mixed|null
     */
    public $platform;

    public function __construct($mail, $scene, $randCode, $keyId, $platform = null)
    {
        $this->mail = $mail;
        $this->scene = $scene;
        $this->randCode = $randCode;
        $this->keyId = $keyId;
        $this->platform = $platform;
    }
}