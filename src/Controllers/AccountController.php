<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\AccountConst;
use Cblink\UserAccount\DTO\LoginDTO;
use Cblink\UserAccount\DTO\ResetPasswordDTO;
use Cblink\UserAccount\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AccountController extends Controller
{

    /**
     * @var AccountService
     */
    protected $service;

    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function login(Request $request)
    {
        $dto = new LoginDTO($request->all());

        list($scene, $params) = $this->service->loginUser($dto);

        return callbackEvent($params, $scene);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function resetPassword(Request $request)
    {
        $dto = new ResetPasswordDTO($request->all());

        $account = $this->service->resetPassword($dto);

        return callbackEvent([$account, $dto], AccountConst::RESET);
    }
}
