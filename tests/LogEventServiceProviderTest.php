<?php

use Kouz\LaravelLog\Providers\LogEventServiceProvider;
use Orchestra\Testbench\TestCase;

class LogEventServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Kouz\LaravelLog\Providers\LogEventServiceProvider'];
    }

    /**
     * @test
     */
    public function is_service_loaded()
    {
    }
}
