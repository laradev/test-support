<?php

namespace Laradev\Test\Support;

use Laradev\Test\Support\Traits\Assertions;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use Assertions;
    
    /**
     * {@inheritdoc}
     */
    final protected function setUp()
    {
        parent::setUp();
        
        $this->doSetUp();
    }
    
    /**
     * Sub classes setUp handler
     */
    abstract protected function doSetUp();
    
    /**
     * {@inheritdoc}
     */
    final protected function tearDown()
    {
        $this->doTearDown();
        
        $this->releaseMocks();
        
        parent::tearDown();        
    }
    
    /**
     * Sub classes tearDown handler
     */
    abstract protected function doTearDown();    
}
