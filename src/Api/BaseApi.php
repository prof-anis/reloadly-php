<?php

namespace Tobexkee\Reloadly\Api;

use Tobexkee\Reloadly\Client;
use Tobexkee\Reloadly\Contract\ApiInterface;
use Tobexkee\Reloadly\Contract\ApplicationInterface;
use Tobexkee\Reloadly\Contract\Config;
use Tobexkee\Reloadly\Exceptions\ClientErrorException;
use Tobexkee\Reloadly\Http\ResponseMediator;
use GuzzleHttp\Exception\ClientException;

abstract class BaseApi implements ApiInterface
{
    protected string $baseUrl;

    private $client;

    private $config;

    public function __construct(ApplicationInterface $app)
    {
        $this->client = $app->make(Client::class);
        $this->config = $app->make(Config::class);
        $this->baseUrl = $this->config->getAudience();
    }

    protected function get(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = count($parameters) > 0
            ? $this->baseUrl . $uri . '?' . http_build_query($parameters)
            : $this->baseUrl . $uri;

        try {
            $response = $this->client->withToken()->get($uri, ['headers' => $headers]);

            return ResponseMediator::getContent($response);
        } catch (ClientException $e) {
            throw new ClientErrorException($e->getMessage());
        }
    }

    protected function post(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = $this->baseUrl . $uri;

        try {
            $response = $this->client->withToken()->post($uri, ['json' => $parameters, 'headers' => $headers]);

            return ResponseMediator::getContent($response);
        } catch (ClientException $e) {
            throw new ClientErrorException($e->getMessage());
        }
    }
}
