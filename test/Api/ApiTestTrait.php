<?php

namespace Tobexkee\Reloadly\Test\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Tobexkee\Reloadly\Client;

trait ApiTestTrait
{
    public function mockClient(array $response, string $url, string $requestType = 'get')
    {
        $baseUrl = 'https://topups-sandbox.reloadly.com';
        $fullUrl = $baseUrl . $url;

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('withToken')->andReturn($guzzleClient = Mockery::mock(new GuzzleClient()));
        $guzzleClient->shouldReceive($requestType)->withArgs(function ($url) use ($fullUrl) {
            return $url == $fullUrl;
        })->andReturn(new Response(200, [], json_encode(['data' => $response])));

        return $client;
    }
}
