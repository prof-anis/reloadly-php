<?php

namespace Tobexkee\Reloadly\Api;

class Operators extends BaseApi
{
    protected const URI = '/operators';

    public function fetch(array $options = []): string | array
    {
        return $this->get(self::URI, $options);
    }

    public function fetchById(string $id, array $options = []): string | array
    {
        return $this->get(self::URI . "/$id", $options);
    }

    public function fetchByIso(string $iso, array $options = []): string | array
    {
        return $this->get(self::URI . '/countries/' . $iso, $options);
    }

    public function fetchByPhone(string|int $phone, string|int $country_iso): string | array
    {
        return $this->get(self::URI . '/auto-detect/phone/' . $phone . '/countries/' . $country_iso);
    }
}
