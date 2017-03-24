<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Laradev\Test\Support\Traits;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Mockery as m;
use Mockery\MockInterface;
use Mockery\CompositeExpectation;

trait MockProvider
{
    /**
     * @var MockInterface
     */
    protected static $functions;
    
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
    
    final public function newFunctionMock(string $functionName):CompositeExpectation
    {
        if (is_null(static::$functions)) {
            static::$functions = m::mock();
        }
        
        return static::$functions->shouldReceive($functionName);
    }
    
    final public static function useFunction(string $functionName, ...$args)
    {
        return call_user_func_array([static::$functions, $functionName], $args);
    }
}