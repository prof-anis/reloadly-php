<?php

namespace Busybrain\Reloadly\Api;

class Discount extends BaseApi
{
    protected const URI = '/operators';

    public function fetch(array $parameters = []): string | array
    {
        return $this->get(self::URI . '/commissions', $parameters);
    }

    public function fetchById($id): string | array
    {
        return   $this->get(self::URI . '/' . $id . '/commissions');
    }
}
