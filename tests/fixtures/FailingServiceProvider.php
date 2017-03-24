<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Laradev\Test\Support\Fixtures;

use Illuminate\Support\ServiceProvider;

final class FailingServiceProvider extends ServiceProvider
{
    const SERVICE_ID = 'failing';
    
    public function boot()
    {
    }
}