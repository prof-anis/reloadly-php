<?php

namespace Tobexkee\Reloadly\Api;

class Account extends BaseApi
{
    protected const URI = '/accounts';

    public function balance(): string | array
    {
        return $this->get(self::URI . '/balance');
    }
}
