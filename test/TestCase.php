<?php

namespace Tobexkee\Reloadly\Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Tobexkee\Reloadly\App as ReloadlyApplication;

class TestCase extends PHPUnitTestCase
{
    public function createApplication()
    {
        return new ReloadlyApplication();
    }
}
