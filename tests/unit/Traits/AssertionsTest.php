<?php

namespace Laradev\Test\Support\Fixtures
{
    use Laradev\Test\Support\Traits\AssertionsTest;
    
    function config_path($path)
    {
        return AssertionsTest::useFunction('config_path', $path);
    }
}

namespace Laradev\Test\Support\Traits
{

use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Laradev\Test\Support\Fixtures\FailingServiceProvider;
use Laradev\Test\Support\Fixtures\NotAServiceProvider;
use Laradev\Test\Support\Fixtures\SucceedingServiceProvider;
use Laradev\Test\Support\TestCase;
use PHPUnit_Framework_AssertionFailedError;

    final class AssertionsTest extends TestCase
    {
        public function testAssertIsSubclassOf()
        {
            $this->assertIsSubclassOf(ServiceProvider::class, SucceedingServiceProvider::class);
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage Failed asserting that the given class is a sub class of Illuminate\Support\ServiceProvider.
         */
        public function testAssertIsSubclassOfFailure()
        {
            $this->assertIsSubclassOf(ServiceProvider::class, NotAerviceProvider::class);
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage A custom message.
         */
        public function testAssertIsSubclassOfCustomMessage()
        {
            $this->assertIsSubclassOf(ServiceProvider::class, NotAerviceProvider::class, 'A custom message.');
        }
        
        public function testAssertBootMergesConfigForProvider()
        {
            $this->assertBootMergesConfigForProvider(
                SucceedingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage Failed asserting that the boot method merges the configuration.
         */
        public function testAssertBootMergesConfigForProviderFailure()
        {
            $this->assertBootMergesConfigForProvider(
                FailingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage A custom message.
         */
        public function testAssertBootMergesConfigForProviderCustomMessage()
        {
            $this->assertBootMergesConfigForProvider(
                FailingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile(),
                'A custom message.'
            );
        }
        
        /**
         * @expectedException InvalidArgumentException
         * @expectedExceptionMessage $providerClass must be of type Illuminate\Support\ServiceProvider.
         */
        public function testAssertBootMergesConfigForProviderCheckProviderType()
        {
            $this->assertBootMergesConfigForProvider(
                NotAServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }

        public function testAssertBootPublishesConfigForProvider()
        {
            $this->assertBootPublishesConfigForProvider(
                SucceedingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage Failed asserting that the boot method publishes the configuration.
         */
        public function testAssertBootPublishesConfigForProviderFailure()
        {
            $this->assertBootPublishesConfigForProvider(
                FailingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }
        
        /**
         * @expectedException PHPUnit_Framework_AssertionFailedError
         * @expectedExceptionMessage A custom message.
         */
        public function testAssertBootPublishesConfigForProviderCustomMessage()
        {
            $this->assertBootPublishesConfigForProvider(
                FailingServiceProvider::class,
                SucceedingServiceProvider::getConfigFile(),
                'A custom message.'
            );
        }
        
        /**
         * @expectedException InvalidArgumentException
         * @expectedExceptionMessage $providerClass must be of type Illuminate\Support\ServiceProvider.
         */
        public function testAssertBootPublishesConfigForProviderCheckProviderType()
        {
            $this->assertBootPublishesConfigForProvider(
                NotAServiceProvider::class,
                SucceedingServiceProvider::getConfigFile()
            );
        }

        protected function doSetUp()
        {
            $this->newFunctionMock('config_path');
            $this->resetServiceProvider();
        }

        protected function doTearDown()
        {

        }
        
        private function resetServiceProvider()
        {
            $statics = [
                'publishes' => [],
                'publishGroups' => []
            ];
            $reflection = new \ReflectionClass(ServiceProvider::class);
            
            foreach ($statics as $name => $defaultValue) {
                $property = $reflection->getProperty($name);
                $property->setAccessible(true);
                $property->setValue(ServiceProvider::class, $defaultValue);
            }
        }
    }
}