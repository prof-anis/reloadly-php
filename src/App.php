<?php

namespace Tobexkee\Reloadly;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tobexkee\Reloadly\Contract\ApiInterface;
use Tobexkee\Reloadly\Contract\ApplicationInterface;
use Tobexkee\Reloadly\Exceptions\BadMethodCallException;

class App extends Container implements ApplicationInterface
{
    protected string $bindPath;

    protected array $apiBindings;

    public string $client_key;

    public string $secret_key;

    public string $env;

    public function __construct(string $client_key = '', string $secret_key = '', string $env = '')
    {
        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
        $this->env = $env;
        $this->bindPath = __DIR__ . '/config/bindings.php';
        $this
            ->vendorBindings()
            ->loadApi()
            ->bindApi();
    }

    protected function loadApi(): App
    {
        $this->apiBindings = require $this->bindPath;

        return $this;
    }

    protected function bindApi(): void
    {
        foreach ($this->apiBindings as $reference => $implementation) {
            $this->bind($reference, function ($app) use ($implementation) {
                return new $implementation($this);
            });
        }
    }

    protected function vendorBindings(): App
    {
        $this->instance(ApplicationInterface::class, $this);
        $this->instance(Config::class, new Config($this->client_key, $this->secret_key, $this->env));
        $this->bind(Client::class, function (ApplicationInterface $app) {
            return new Client($app);
        });

        return $this;
    }

    public function makeApi(string $api): ApiInterface
    {
        try {
            return	$this->make($api);
        } catch (BindingResolutionException $e) {
            throw new BadMethodCallException("the {$api} api does not exist");
        }
    }
}
