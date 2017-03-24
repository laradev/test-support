<?php

namespace Laradev\Test\Support;

use Laradev\Test\Support\Traits\Assertions;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use Assertions;
    
    final protected function setUp()
    {
        parent::setUp();
        
        $this->doSetUp();
    }
    
    abstract protected function doSetUp();
    
    final protected function tearDown()
    {
        $this->doTearDown();
        
        $this->releaseMocks();
        
        parent::tearDown();        
    }
    
    abstract protected function doTearDown();    
}
