<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount;

use LogicException;
use Throwable;

class AccountException extends LogicException
{
    public function __construct($code = AccountError::ERR_UNKNOWN)
    {
        parent::__construct(sprintf("error code %s", $code), $code);
    }
}
