<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Illuminate\Routing\Controller;

/**
 * Class BaseController
 * @package Cblink\UserAccount\Controllers
 */
class BaseController extends Controller
{
    /**
     * 调用事件里的回调
     *
     * @param array $params
     * @param string $name
     * @return mixed
     */
    public function callbackEvent(array $params = [], $name = Account::RESPONSE)
    {
        $closure = app(Account::class)->{$name};

        return call_user_func_array($closure, $params);
    }
}
