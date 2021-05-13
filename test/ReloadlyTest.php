<?php

namespace Busybrain\Reloadly\Test;

use Busybrain\Reloadly\Api\Account;
use Busybrain\Reloadly\Api\Countries;
use Busybrain\Reloadly\Api\Discount;
use Busybrain\Reloadly\Api\Fxrate;
use Busybrain\Reloadly\Api\Operators;
use Busybrain\Reloadly\Api\Promotions;
use Busybrain\Reloadly\Api\Topup;
use Busybrain\Reloadly\Api\Transactions;
use Busybrain\Reloadly\Exceptions\BadMethodCallException;
use Busybrain\Reloadly\Reloadly;
use PHPUnit\Framework\TestCase;

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
