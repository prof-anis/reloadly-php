<?php

namespace Tobexkee\Reloadly\Test\Api;

use Tobexkee\Reloadly\Api\Topup;
use Tobexkee\Reloadly\App;
use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Test\TestCase;

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
