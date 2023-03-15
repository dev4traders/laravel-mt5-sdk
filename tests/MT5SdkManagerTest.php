<?php

namespace D4T\MT5Sdk\Tests;

use D4T\MT5Sdk\Facades\MT5Manager;
use D4T\MT5Sdk\MT5SdkServiceProvider;
use D4T\MT5Sdk\Resources\Account;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as Orchestra;

class MT5SdkTest extends Orchestra
{

    private ?Account $account = null;

    /**
     * @test
     */
    public function can_ping()
    {
        $this->assertTrue(MT5Manager::ping());
    }

    /**
     * @test
     */
    public function not_zero_list_account_logins()
    {
        $this->assertNotCount(0, MT5Manager::listAccountLogins());
    }

    /**
     * @test
     */
    public function can_create_account()
    {
        $this->account = MT5Manager::createAccount(['name' => 'TestL', 'email' => 'testl@test.com', 'group' => 'demoHFX-USD']);
        $this->assertEquals('TestL', $this->account->name);
    }

    /**
     * @test
     */
    public function can_update_account()
    {
        if($this->account) {
            $this->account = MT5Manager::updateAccount($this->account->login, ['name' => 'TestU']);
            return $this->assertEquals('TestU', $this->account->name);
        }

        return $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function can_delete_account()
    {
        if($this->account)
            return $this->assertTrue(MT5Manager::deleteAccount($this->account->login));

        return $this->assertTrue(false);
    }

    public function setUp(): void
    {
        parent::setUp();
        MT5Manager::setTimeout(3);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
    }

    protected function getPackageProviders($app)
    {
        return [
            MT5SdkServiceProvider::class,
        ];
    }
}