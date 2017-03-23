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
    
    protected function doSetUp()
    {
        
    }

    protected function doTearDown()
    {
        
    }
}