<?php

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
    const REGISTER = 'register';
    const LOGIN = 'login';
    const RESET = 'reset';
    const SOCIALITE = 'socialite';

    const RESPONSE = 'response';

    const EVENTS = [
        self::REGISTER,
        self::LOGIN,
        self::RESET,
        self::SOCIALITE,
        self::RESPONSE,
    ];

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
        $this->events[self::RESPONSE] = function ($data) {
            return $data;
        };
    }

    public function __call($name, $arguments)
    {
        if (!in_array($name, self::EVENTS)) {
            throw new InvalidArgumentException(sprintf('method %s not defined', $name));
        }

        list($closure) = $arguments;

        $this->events[$name] = $closure;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->events)) {
            return $this->events[$name];
        }

        return $this->events[self::RESPONSE];
    }
}
