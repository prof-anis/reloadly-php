<?php

namespace Tobexkee\Reloadly\Api;

class Discount extends BaseApi
{
    protected const URI = '/operators';

    public function fetch(array $parameters = []): string | array
    {
        return $this->get(self::URI . '/commissions', $parameters);
    }

    public function fetchById(string | int $id): string | array
    {
        return   $this->get(self::URI . '/' . $id . '/commissions');
    }
}
