<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Countries;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

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
