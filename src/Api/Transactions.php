<?php

namespace Tobexkee\Reloadly\Api;

class Transactions extends BaseApi
{
    protected const URI = '/topups/reports/transactions';

    public function fetch(string $id = null): string | array
    {
        return $id == null
                    ? $this->get(self::URI)
                    : $this->get(self::URI . '/' . $id);
    }
}
