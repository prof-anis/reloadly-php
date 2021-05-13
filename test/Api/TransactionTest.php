<?php

namespace Busybrain\Reloadly\Test;

use Busybrain\Reloadly\Api\Transactions;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\Api\ApiTestTrait;

class TransactionTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchTransactions(): void
    {
        $msg = ['transactions' => 'some transactions'];

        $client = $this->mockClient($msg, '/topups/reports/transactions', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $transaction = new Transactions($app);
        $this->assertSame($transaction->fetch(), $msg);
    }
}
