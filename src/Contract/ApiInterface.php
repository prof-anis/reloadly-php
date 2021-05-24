<?php

namespace Tobexkee\Reloadly\Contract;

interface ApiInterface
{
    public function get(string $uri, array $parameters = [], array $headers = []): string | array;

    public function post(string $uri, array $parameters = [], array $headers = []): string | array;
}
