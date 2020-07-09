<?php


namespace Cblink\UserAccount;

use Throwable;
use LogicException;

class AccountException extends LogicException
{
    public function __construct($code = AccountError::ERR_UNKNOWN)
    {
        parent::__construct(sprintf("error code %s", $code), $code);
    }
}
