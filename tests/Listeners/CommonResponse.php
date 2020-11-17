<?php


namespace Tests\Listeners;


use Cblink\UserAccount\Events\UserActionEvent;

class CommonResponse
{
    public function handle(UserActionEvent $event)
    {
        $event->account->response(function($data){
            /**
             * @var array $data
             */

            // 处理通用的返回事件
            // ...

            return ['data' => $data];
        });
    }
}