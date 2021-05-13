<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Fxrate;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

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
