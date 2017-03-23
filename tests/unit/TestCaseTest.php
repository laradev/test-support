<?php

namespace Laradev\Test\Support;

final class TestCaseTest extends TestCase
{
    private $called;
    
    public function testSetUp()
    {
        $this->called = false;
        
        $this->setUp();
        
        $this->assertTrue($this->called);        
    }
    
    public function testTearDown()
    {
        $this->called = false;
        
        $this->tearDown();
        
        $this->assertTrue($this->called);        
    }

    protected function doSetUp()
    {
        $this->called = true;
    }

    protected function doTearDown()
    {
        $this->called = true;
    }
}
