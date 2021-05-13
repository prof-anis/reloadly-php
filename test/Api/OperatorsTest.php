<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Operators;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

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
