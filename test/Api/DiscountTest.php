<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Discount;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

class DiscountTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchAllDiscounts(): void
    {
        $msg = ['discounts' => ['some discounts']];
        $client = $this->mockClient($msg, '/operators/commissions', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $discount = new Discount($app);
        $this->assertSame($discount->fetch(), $msg);
    }

    /**
     * @test
     */
    public function willFetchById(): void
    {
        $msg = ['discounts' => ['some discounts']];
        $client = $this->mockClient($msg, '/operators/41/commissions', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $discount = new Discount($app);
        $this->assertSame($discount->fetchById(41), $msg);
    }
}
