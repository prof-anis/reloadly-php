<?php

namespace Busybrain\Reloadly;

use Busybrain\Reloadly\Api\BaseApi;

class Reloadly
{
    public function __construct(?string $client_id = '', ?string $client_secret = '', string $env = 'sandbox')
    {
        $this->app = new App($client_id, $client_secret, $env);
    }

    public function __call(string $method, array $args): BaseApi
    {
        return $this->app->makeApi($method);
    }
}