<?php

namespace D4T\MT5Sdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see D4T\MT5Sdk\Manager
 * @method static string apiToken()
 * @method static string endpoint()
 * @method static bool ping()
 * @method static array listAccountLogins()
 * @method static Account getAccount(int $login)
 * @method static Account createAccount(array $data)
 * @method static Account updateAccount(int $login, array $data):
 * @method static bool deleteAccount(int $login)
 * @method static Trade openTrade(int $accountLogin, array $data)
 * @method static void closeTrade(int $ticket)
 */
class MT5Manager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \D4T\MT5Sdk\Manager::class;
    }
}
