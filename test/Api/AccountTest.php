<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Account;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

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
