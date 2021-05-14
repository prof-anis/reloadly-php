<?php

namespace Tobexkee\Reloadly\Api;

class Promotions extends BaseApi
{
    protected const URI = '/promotions';

    public function fetch(array $data = []): string | array
    {
        return $this->get(self::URI, $data);
    }

    public function fetchById(string $id): string | array
    {
        return $this->get(self::URI . '/' . $id);
    }

    public function fetchByCountry(string $country_code): string | array
    {
        return $this->get(self::URI . '/country-codes/' . $country_code);
    }

    public function fetchByOperator(string $operator): string | array
    {
        return $this->get(self::URI . '/operators/' . $operator);
    }
}
