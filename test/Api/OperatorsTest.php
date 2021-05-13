<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Api\Operators;
use Tobexkee\Reloadly\Test\TestCase;
use Tobexkee\Reloadly\Test\Api\ApiTestTrait;

class OperatorsTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchOperators(): void
    {
        $msg = ['operators' => ['some operators']];
        $client = $this->mockClient($msg, '/operators', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $operator = new Operators($app);
        $this->assertSame($operator->fetch(), $msg);
    }

    /**
     * @test
     */
    public function willFetchById(): void
    {
        $msg = ['operators' => ['some operators']];
        $client = $this->mockClient($msg, '/operators/some-id', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $operator = new Operators($app);
        $this->assertSame($operator->fetchById('some-id'), $msg);
    }

    /**
     * @test
     */
    public function willfetchByIso(): void
    {
        $msg = ['operators' => ['some operators']];
        $client = $this->mockClient($msg, '/operators/countries/some-iso', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $operator = new Operators($app);
        $this->assertSame($operator->fetchByIso('some-iso'), $msg);
    }

    /**
     * @test
     */
    public function willFetchByPhone(): void
    {
        $msg = ['operators' => ['some operators']];
        $client = $this->mockClient($msg, '/operators/auto-detect/phone/some-phone/countries/some-country-iso', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $operator = new Operators($app);
        $this->assertSame($operator->fetchByPhone('some-phone', 'some-country-iso'), $msg);
    }
}
