<?php

namespace Cblink\UserAccount\Controllers;

use Cblink\UserAccount\Account;
use Cblink\UserAccount\AccountConst;
use Illuminate\Http\Request;
use Cblink\UserAccount\DTO\LoginDTO;
use Cblink\UserAccount\DTO\ResetPasswordDTO;
use Cblink\UserAccount\Services\AccountService;

class AccountController extends BaseController
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

        list($platform, $params) = $this->service->loginUser($dto);

        return $this->callbackEvent($params, $platform);
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

        return $this->callbackEvent([$account], AccountConst::RESET);
    }
}
