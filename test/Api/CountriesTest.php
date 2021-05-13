<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Api\Countries;
use Tobexkee\Reloadly\Test\TestCase;
use Tobexkee\Reloadly\Test\Api\ApiTestTrait;

class CountriesTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willFetchAllCountries(): void
    {
        $msg = ['countries' => [
            'country 1' => ['some details'],
            'country 2' => ['some details'],
        ]];

        $client = $this->mockClient($msg, '/countries', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $countries = new Countries($app);
        $this->assertSame($countries->fetch(), $msg);
    }

    /**
     * @test
     */
    public function willFetchCountryByIso(): void
    {
        $msg = ['country' => ['some details']];

        $client = $this->mockClient($msg, '/countries/NGN', 'get');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $countries = new Countries($app);
        $this->assertSame($countries->fetch('NGN'), $msg);
    }
}
