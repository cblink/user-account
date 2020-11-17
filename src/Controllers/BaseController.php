<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
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
    public function callbackEvent(array $params = [], $name = AccountConst::RESPONSE)
    {
        $account = app(Account::class);

        if (!property_exists($account, $name)) {
            // @todo 异常处理
        }

        return call_user_func_array($account->{$name}, $params);
    }
}
