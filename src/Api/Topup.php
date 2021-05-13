<?php

namespace Busybrain\Reloadly\Api;

class Topup extends BaseApi
{
    protected const URI = '/topups';

    public function send(array $data): string | array
    {
        return $this->post(self::URI, $data);
    }
}
