<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Laradev\Test\Support\Traits;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Mockery as m;
use Mockery\MockInterface;

trait MockProvider
{
    final public function releaseMocks()
    {
        m::close();
    }
    
    final public function newAppMock():MockInterface
    {
        return m::mock(Application::class);
    }
    
    final public function newConfigMock():MockInterface
    {
        return m::mock(Repository::class);
    }
}