<?php

/*
 * This file is part of the cblink/user-account.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\UserAccount;

use Closure;
use InvalidArgumentException;

/**
 * Class Account
 * @package Cblink\UserAccount
 * @method login(Closure $closure)
 * @method register(Closure $closure)
 * @method reset(Closure $closure)
 * @method socialite(Closure $closure)
 * @method response(Closure $closure)
 *
 * @property Closure $login
 * @property Closure $reset
 * @property Closure $register
 * @property Closure $socialite
 * @property Closure $response
 */
class Account
{
    /**
     * @var array
     */
    protected $events = [];

    public function __construct()
    {
        $this->defaultResponse();
    }

    public function defaultResponse()
    {
        $this->events[AccountConst::RESPONSE] = function ($data) {
            return $data;
        };
    }

    public function __call($name, $arguments)
    {
        if (!in_array($name, AccountConst::EVENTS)) {
            throw new InvalidArgumentException(sprintf('method %s not defined', $name));
        }

        list($closure) = $arguments;

        $this->events[$name] = $closure;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->events);
    }

    public function __get($name)
    {
        if ($this->__isset($name)) {
            return $this->events[$name];
        }

        return $this->events[AccountConst::RESPONSE];
    }
}
