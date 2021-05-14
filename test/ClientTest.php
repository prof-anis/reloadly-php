<?php

namespace Tobexkee\Reloadly\Test;

use Tobexkee\Reloadly\Client;

class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        $app = $this->createApplication();
        $this->client = $app->make(Client::class);
    }

    /**
     * @test
     */
    public function setHeader(): void
    {
        $this->client->addHeader('HEADER_TYPE', 'HEADER_VALUE');
        $this->assertTrue(in_array('HEADER_VALUE', $this->client->getHeaders()));
        $this->assertArrayHasKey('HEADER_TYPE', $this->client->getHeaders());
    }

    /**
     * @test
     */
    public function validManHeaders(): void
    {
        $this->client->withMainHeaders();
        $this->assertTrue(in_array('application/json', $this->client->getHeaders()));
        $this->assertArrayHasKey('Content-Type', $this->client->getHeaders());
    }
}
