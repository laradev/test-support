<?php

namespace Laradev\Test\Support\Traits;

use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Mockery;
use stdClass;

trait Assertions
{
    use MockProvider;
    
    final public function assertIsSubclassOf(string $expectedParent, string $actual, string $message = '')
    {
        $defaultMessage = 'Failed asserting that the given class is a sub class of Illuminate\Support\ServiceProvider.';
        
        $this->assertTrue(is_subclass_of($actual, $expectedParent), $this->message($defaultMessage, $message));
    }
    
    final public function assertBootMergesConfigForProvider(string $providerClass, string $configfile, string $message = '')
    {
        if (is_subclass_of($providerClass, ServiceProvider::class)) {
            $defaultMessage = 'Failed asserting that the boot method merges the configuration.';
            $spy = new stdClass();
            $spy->called = false;
            $app = ['config' => $this->newConfigMock()];
            $app['config']
                ->shouldReceive('get')
                ->andReturn([])
                ->shouldReceive('set')
                ->with(
                    Mockery::any(),
                    require $configfile
                )
                ->andReturnUsing(
                    function() use ($spy) {
                        $spy->called = true;
                    }
                );

            (new $providerClass($app))->boot();

            $this->assertTrue($spy->called, $this->message($defaultMessage, $message));
            
        } else {
            throw new InvalidArgumentException('$providerClass must be of type Illuminate\Support\ServiceProvider.');
        }
    }
    
    final public function assertBootPublishesConfigForProvider(string $providerClass, string $configfile, string $message = '')
    {
        if (is_subclass_of($providerClass, ServiceProvider::class)) {
            $defaultMessage = 'Failed asserting that the boot method publishes the configuration.';
            $app = ['config' => $this->newConfigMock()];
            $app['config']
                ->shouldIgnoreMissing()
                ->shouldReceive('get')
                ->andReturn([]);
            $provider = new $providerClass($app);

            $provider->boot();
            
            $this->assertArrayHasKey(
                $configfile,
                $provider->pathsToPublish(),
                $this->message($defaultMessage, $message)
            );
        
        } else {
            throw new InvalidArgumentException('$providerClass must be of type Illuminate\Support\ServiceProvider.');
        }
    }
    
    final protected function message($default, $message = ''):string
    {
        return empty($message) ? $default : $message;
    }
}