<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

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
