<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\Api\Fxrate;
use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Test\TestCase;

class FxrateTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willGetFxRate(): void
    {
        $msg = ['fx_rate' => ['some rates']];
        $client = $this->mockClient($msg, '/operators/fx-rate', 'post');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $rate = new Fxrate($app);
        $this->assertSame($rate->fetch('operator', 'amount'), $msg);
    }
}
