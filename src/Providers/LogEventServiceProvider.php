<?php

namespace Kouz\LaravelLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class LogEventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        'Kouz\LaravelLog\Listeners\LogEventSubscriber',
    ];
}
