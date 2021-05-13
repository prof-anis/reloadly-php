<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\Api\Discount;
use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Test\TestCase;

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
