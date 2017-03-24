<?php

namespace Laradev\Test\Support\Traits;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Laradev\Test\Support\TestCase;
use Mockery\MockInterface;

final class MockProviderTest extends TestCase
{
    public function testNewMock()
    {
        $this->assertInstanceOf(MockInterface::class, $this->newMock());
        $this->assertInstanceOf(Application::class, $this->newMock(Application::class));
    }
    
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
        $this->newFunctionMock('callme')
            ->with($arg1, $arg2)
            ->andReturn(true);
        function callme($arg1, $arg2)
        {
            return MockProviderTest::useFunction('callme', $arg1, $arg2);
        }
        
        $this->assertTrue(callme($arg1, $arg2));            
    }
    
    /**
     * {@inheritdoc}
     */
    protected function doSetUp()
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    protected function doTearDown()
    {
        
    }
}