<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\Api\Promotions;
use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Test\TestCase;

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
