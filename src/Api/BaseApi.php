<?php

namespace Busybrain\Reloadly\Api;

use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Contract\ApiInterface;
use Busybrain\Reloadly\Contract\ApplicationInterface;
use Busybrain\Reloadly\Exceptions\ClientErrorException;
use Busybrain\Reloadly\Http\ResponseMediator;
use GuzzleHttp\Exception\ClientException;

abstract class BaseApi implements ApiInterface
{
    protected const BASE_URI = 'https://topups-sandbox.reloadly.com';

    private $client;

    public function __construct(ApplicationInterface $app)
    {
        $this->client = $app->make(Client::class);
    }

    protected function get(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = count($parameters) > 0
            ? self::BASE_URI . $uri . '?' . http_build_query($parameters)
            : self::BASE_URI . $uri;

        try {
            $response = $this->client->withToken()->get($uri, ['headers' => $headers]);

            return ResponseMediator::getContent($response);
        } catch (ClientException $e) {
            throw new ClientErrorException($e->getMessage());
        }
    }

    protected function post(string $uri, array $parameters = [], array $headers = []): string | array
    {
        $uri = self::BASE_URI . $uri;

        try {
            $response = $this->client->withToken()->post($uri, ['json' => $parameters, 'headers' => $headers]);

            return ResponseMediator::getContent($response);
        } catch (ClientException $e) {
            throw new ClientErrorException($e->getMessage());
        }
    }
}
