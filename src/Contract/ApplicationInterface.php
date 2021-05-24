<?php

namespace Tobexkee\Reloadly\Contract;

interface ApplicationInterface
{
    public function makeApi(string $api): ApiInterface;
}
