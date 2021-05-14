<?php

namespace Tobexkee\Reloadly\Test;

use PHPUnit\Framework\TestCase;
use Tobexkee\Reloadly\Api\Account;
use Tobexkee\Reloadly\Api\Countries;
use Tobexkee\Reloadly\Api\Discount;
use Tobexkee\Reloadly\Api\Fxrate;
use Tobexkee\Reloadly\Api\Operators;
use Tobexkee\Reloadly\Api\Promotions;
use Tobexkee\Reloadly\Api\Topup;
use Tobexkee\Reloadly\Api\Transactions;
use Tobexkee\Reloadly\Exceptions\BadMethodCallException;
use Tobexkee\Reloadly\Reloadly;

class ReloadlyTest extends TestCase
{
    private Reloadly $reloadly;

    protected function setUp(): void
    {
        $this->reloadly = new Reloadly();
    }

    /**
     * @test
     */
    public function willThrowExceptionWhenInvalidApiIsCalled(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->reloadly->thisApiDoesNotExist();
    }

    /**
     * @dataProvider provideApi
     *
     * @test
     */
    public function apiReturnsAppropriateObject($api, $object): void
    {
        $this->assertInstanceOf($object, (new Reloadly())->{$api}());
    }

    public function provideApi()
    {
        return [
            [
                'countries',
                Countries::class,
            ],
            [
                'account',
                Account::class,
            ],
            [
                'discount',
                Discount::class,
            ],
            [
                'fxrate',
                Fxrate::class,
            ],
            [
                'operators',
                Operators::class,
            ],
            [
                'topup',
                Topup::class,
            ],
            [
                'transactions',
                Transactions::class,
            ],
            [
                'promotions',
                Promotions::class,
            ],
        ];
    }
}
