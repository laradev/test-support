<?php

namespace Laradev\Test\Support\Traits;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Laradev\Test\Support\TestCase;

final class MockProviderTest extends TestCase
{
    public function testNewAppMock()
    {
        $this->assertInstanceOf(Application::class, $this->newAppMock());
    }
    
    public function testNewConfigMock()
    {
        $this->assertInstanceOf(Repository::class, $this->newConfigMock());
    }
    
    public function testMockingFunctions()
    {
        $arg1 = 'something';
        $arg2 = 'else';
        $function = $this->newFunctionMock('callme')
            ->with($arg1, $arg2)
            ->andReturn(true);
        function callme($arg1, $arg2)
        {
            return MockProviderTest::useFunction('callme', $arg1, $arg2);
        }
        
        $this->assertTrue(callme($arg1, $arg2));            
    }
    
    protected function doSetUp()
    {
        
    }

    protected function doTearDown()
    {
        
    }
}