<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Api\Account;
use Tobexkee\Reloadly\Test\TestCase;
use Tobexkee\Reloadly\Test\Api\ApiTestTrait;

class AccountTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchAccountBalance(): void
    {
        $msg = ['balance' => 30];
        $client = $this->mockClient($msg, '/accounts/balance', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $account = new Account($app);
        $this->assertSame($account->balance(), $msg);
    }
}
