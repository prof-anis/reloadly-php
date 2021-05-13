<?php

namespace Busybrain\Reloadly\Test;

use Busybrain\Reloadly\App as ReloadlyApplication;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    public function createApplication()
    {
        return new ReloadlyApplication();
    }
}
