<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendMail
 * @package Cblink\UserAccount\Events
 */
class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
