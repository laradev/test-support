<?php

namespace Laradev\Test\Support;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    final protected function setUp()
    {
        parent::setUp();
        
        $this->doSetUp();
    }
    
    abstract protected function doSetUp();
    
    final protected function tearDown()
    {
        $this->doTearDown();
        
        parent::tearDown();        
    }
    
    abstract protected function doTearDown();    
}
