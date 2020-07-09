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
    public $event;

    /**
     * @var string
     */
    public $randCode;

    /**
     * @var string
     */
    public $keyId;

    public function __construct($mail, $event, $randCode, $keyId)
    {
        $this->mail = $mail;
        $this->event = $event;
        $this->randCode = $randCode;
        $this->keyId = $keyId;
    }
}