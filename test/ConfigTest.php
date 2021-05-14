<?php

namespace Tobexkee\Reloadly\Test;

use Tobexkee\Reloadly\Config;

class ConfigTest extends TestCase
{
    protected function setUp(): void
    {
        $this->config = new Config();
    }

    /**
     * @test
     */
    public function getSecretKey(): void
    {
        $this->assertTrue($this->config->getSecretKey() === getenv('RELOADLY_SECRET_KEY'));
    }

    /**
     * @test
     */
    public function getClientKey(): void
    {
        $this->assertTrue($this->config->getClientKey() === getenv('RELOADLY_CLIENT_KEY'));
    }

    /**
     * @test
     */
    public function getEnv(): void
    {
        $this->assertTrue($this->config->getAudience() === 'https://topups-sandbox.reloadly.com');
    }
}
