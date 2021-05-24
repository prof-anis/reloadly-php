<?php

namespace Tobexkee\Reloadly\Api;

use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Config;
use Tobexkee\Reloadly\Contract\ApiInterface;
use Tobexkee\Reloadly\Contract\ApplicationInterface;
use Tobexkee\Reloadly\Http\ResponseMediator;

abstract class BaseApi implements ApiInterface
{
    protected string $baseUrl;

    private Client $client;

    private Config $config;

    public function __construct(ApplicationInterface $app)
    {
        $this->client = $app->make(Client::class);
        $this->config = $app->make(Config::class);
        $this->baseUrl = $this->config->getAudience();
    }

    public function get(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = count($parameters) > 0
            ? $this->baseUrl . $uri . '?' . http_build_query($parameters)
            : $this->baseUrl . $uri;

        $response = $this->client->withToken()->get($uri, ['headers' => $headers]);

        return ResponseMediator::getContent($response);
    }

    public function post(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = $this->baseUrl . $uri;

        $response = $this->client->withToken()->post($uri, ['json' => $parameters, 'headers' => $headers]);

        return ResponseMediator::getContent($response);
    }
}
