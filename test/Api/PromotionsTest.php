<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Promotions;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

class PromotionsTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchAllPromotions(): void
    {
        $msg = ['promotions' => ['some promotions']];
        $client = $this->mockClient($msg, '/promotions', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $promotions = new Promotions($app);
        $this->assertSame($promotions->fetch(), $msg);
    }

    /**
     * @test
     */
    public function willFetchById(): void
    {
        $msg = ['promotions' => ['some promotions']];
        $client = $this->mockClient($msg, '/promotions/41', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $promotions = new Promotions($app);
        $this->assertSame($promotions->fetchById(41), $msg);
    }

    /**
     * @test
     */
    public function willFetchByCountryCode(): void
    {
        $msg = ['promotions' => ['some promotions']];
        $client = $this->mockClient($msg, '/promotions/country-codes/NGN', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $promotions = new Promotions($app);
        $this->assertSame($promotions->fetchByCountry('NGN'), $msg);
    }

    /**
     * @test
     */
    public function willFetchByOperator(): void
    {
        $msg = ['promotions' => ['some promotions']];
        $client = $this->mockClient($msg, '/promotions/operators/operator', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $promotions = new Promotions($app);
        $this->assertSame($promotions->fetchByOperator('operator'), $msg);
    }
}
