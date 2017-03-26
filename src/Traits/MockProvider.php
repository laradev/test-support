<?php

namespace Laradev\Test\Support\Traits;

use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\Foundation\Application;
use Mockery as m;
use Mockery\CompositeExpectation;
use Mockery\MockInterface;

trait MockProvider
{
    /**
     * Base Mock for mocking functions
     * 
     * @var MockInterface
     */
    protected static $functions;
    
    /**
     * Releases mocks and do some cleanup
     */
    final public function releaseMocks()
    {
        m::close();
    }
    
    /**
     * Create a new mock of a given type
     * 
     * @param mixed $whatToMock
     * @return MockInterface
     */
    final public function newMock($whatToMock = null):MockInterface
    {
        return is_null($whatToMock) ? m::mock() : m::mock($whatToMock);
    }
    
    /**
     * Create a new Application mock
     * 
     * @return MockInterface
     */
    final public function newAppMock():MockInterface
    {
        return $this->newMock(Application::class);
    }
    
    /**
     * Create a new Repository mock
     * 
     * @return MockInterface
     */
    final public function newConfigMock():MockInterface
    {
        return $this->newMock(Repository::class);
    }
    
    /**
     * Create an Illuminate container with a config mock
     * 
     * The config is accessible using 'config' key.
     * 
     * @return ContainerContract
     */
    final public function newAppContainerWithConfigMock():ContainerContract
    {
        $app = new Container();
        $app['config'] = $this->newConfigMock();
        
        return $app;
    }

    /**
     * Create a new function mock
     * 
     * @param string $functionName
     * @return CompositeExpectation
     */
    final public function newFunctionMock(string $functionName):CompositeExpectation
    {
        if (is_null(static::$functions)) {
            static::$functions = $this->newMock();
        }
        
        return static::$functions->shouldReceive($functionName);
    }
    
    /**
     * Call the mocked function
     * 
     * @param string $functionName
     * @param mixed $args
     * @return mixed
     */
    final public static function useFunction(string $functionName, ...$args)
    {
        return call_user_func_array([static::$functions, $functionName], $args);
    }
}