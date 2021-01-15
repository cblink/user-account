<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Listeners;

use Cblink\UserAccount\Events\UserActionEvent;

class CommonResponse
{
    public function handle(UserActionEvent $event)
    {
        $event->account->response(function ($data) {
            /**
             * @var array $data
             */

            // 处理通用的返回事件
            // ...

            return ['data' => $data];
        });
    }
}
