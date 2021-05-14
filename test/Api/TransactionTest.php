<?php

namespace Tobexkee\Reloadly\Test;

use Tobexkee\Reloadly\Api\Transactions;
use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Test\Api\ApiTestTrait;

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
