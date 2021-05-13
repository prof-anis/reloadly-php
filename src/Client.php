<?php

namespace Tobexkee\Reloadly;

use Tobexkee\Reloadly\Contract\ApplicationInterface;
use Tobexkee\Reloadly\Contract\Config;
use Tobexkee\Reloadly\Http\ResponseMediator;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected array $headers = [];

    protected GuzzleClient $client;

    public function __construct(ApplicationInterface $app)
    {
        $this->config = $app->make(Config::class);
    }

    protected function getClient(): GuzzleClient
    {
        $this->client = new GuzzleClient(['headers' => $this->headers]);

        return $this->client;
    }

    public function addHeader($type, $value): Client
    {
        $this->headers[$type] = $value;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function withMainHeaders(): Client
    {
        $this->addHeader('Content-Type', 'application/json');

        return $this;
    }

    protected function getAuthToken(): string
    {
        $response = $this->withMainHeaders()->getClient()->post($this->config->getAuthUri(), [
            'json' => [
                'audience' => $this->config->getAudience(),
                'client_id' => $this->config->getClientKey(),
                'client_secret' => $this->config->getSecretKey(),
                'grant_type' => 'client_credentials',
            ],
        ]);

        return ResponseMediator::getContent($response)['access_token'];
    }

    public function withToken(): GuzzleClient
    {
        $this->headers = [];
        $this->addHeader('Authorization', sprintf('Bearer %s', $this->getAuthToken()));

        return $this->getClient();
    }
}
