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
    
    final public function newMock($whatToMock = null):MockInterface
    {
        return is_null($whatToMock) ? m::mock() : m::mock($whatToMock);
    }
    
    final public function newAppMock():MockInterface
    {
        return $this->newMock(Application::class);
    }
    
    final public function newConfigMock():MockInterface
    {
        return $this->newMock(Repository::class);
    }
    
    final public function newFunctionMock(string $functionName):CompositeExpectation
    {
        if (is_null(static::$functions)) {
            static::$functions = $this->newMock();
        }
        
        return static::$functions->shouldReceive($functionName);
    }
    
    final public static function useFunction(string $functionName, ...$args)
    {
        return call_user_func_array([static::$functions, $functionName], $args);
    }
}