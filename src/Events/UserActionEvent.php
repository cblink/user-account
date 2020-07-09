<?php

namespace Cblink\UserAccount\Events;

use Cblink\UserAccount\Account;

class UserActionEvent
{
    /**
     * @var Account
     */
    public $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }
}
