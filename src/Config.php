<?php

namespace Tobexkee\Reloadly;

use Tobexkee\Reloadly\Exceptions\RuntimeException;

class Config
{
    protected string $client_key;

    protected string $secret_key;

    protected string $env;

    protected const ALLOWED_ENV = [
        'sandbox',
        'live',
    ];

    protected const AUTH_URI = 'https://auth.reloadly.com/oauth/token';

    protected const SANDBOX_URI = 'https://topups-sandbox.reloadly.com';

    protected const LIVE_URI = 'https://topups.reloadly.com';

    public function __construct(?string $client_key = '', ?string $secret_key = '', string $env = '')
    {
        $this->client_key = $client_key ?: getenv('RELOADLY_CLIENT_KEY');
        $this->secret_key = $secret_key ?: getenv('RELOADLY_SECRET_KEY');
        $this->env = $env ?: getenv('RELOADLY_ENV');

        if (! $this->client_key || ! $this->secret_key) {
            throw new RuntimeException('Secret key and/or public key not set');
        }

        if (! in_array($this->env, self::ALLOWED_ENV)) {
            throw new RuntimeException('Unrecognised environment. Environment can only be sandbox or live.');
        }
    }

    public function getClientKey(): string
    {
        return $this->client_key;
    }

    public function getSecretKey(): string
    {
        return $this->secret_key;
    }

    public function getAuthUri(): string
    {
        return self::AUTH_URI;
    }

    public function getAudience(): string
    {
        return $this->env == 'sandbox'
            ? self::SANDBOX_URI
            : self::LIVE_URI;
    }
}
