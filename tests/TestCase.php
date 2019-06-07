<?php

namespace Tests;

use Flasher\FlasherServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [FlasherServiceProvider::class];
    }
}
