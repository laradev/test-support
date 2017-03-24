<?php

namespace Laradev\Test\Support;

final class TestCaseTest extends TestCase
{
    /**
     * Flag to ensure a method is called
     * 
     * @var boolean
     */
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

    /**
     * {@inheritdoc}
     */
    protected function doSetUp()
    {
        $this->called = true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doTearDown()
    {
        $this->called = true;
    }
}
