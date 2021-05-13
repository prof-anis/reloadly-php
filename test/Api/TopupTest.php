<?php

namespace Busybrain\Reloadly\Test\Api;

use Busybrain\Reloadly\Api\Topup;
use Busybrain\Reloadly\App;
use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Test\TestCase;

class TopupTest extends TestCase
{
    use ApiTestTrait;

    /**
     * @test
     */
    public function willSendTopup(): void
    {
        $msg = ['send' => ['some topup details']];
        $client = $this->mockClient($msg, '/topups', 'post');

        $app = new App();
        $app->bind(Client::class, fn () => $client);
        $topup = new Topup($app);
        $this->assertSame($topup->send([]), $msg);
    }
}
