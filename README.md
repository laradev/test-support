Laradev Test Support
====================
This package provides helpers and utilities to facilitate testing of Laradev packages.

Install
-------
`composer require --dev laradev/test-support`

Usage
-----
### Create a test case
Simply extend the class `Laradev\Test\Support\TestCase`.    

```php
namespace Example

use Laradev\Test\Support\TestCase;

final class ExampleClassTest extends TestCase
{
    /** implement abstract methods **/
} 
```

Utilities
---------
The `TestCase` embeds a bunch of utilities in the form of traits.    
Even if they can be used independently, it is more reliable to extends the `TestCase` class.

### Assertions
The `Assertions` trait enhances the `TestCase` class with new assertions directly accessible to `$this`.
- `assertIsSubclassOf(string $expectedParent, string $actual, string $message = '')`: asserts that the actual class is a sub class of a given one.
- `assertBootMergesConfigForProvider(string $providerClass, string $configfile, string $message = '')`: asserts that the `boot` method of a given service provider instance merges the configuration of its package with the main application one.
- `assertBootPublishesConfigForProvider(string $providerClass, string $configfile, string $message = '')`: asserts that the `boot` method of a given service provider instance publishes the configuration file to the application configuration path.

### MockProvider
The `MockProvider` trait offers a set of factory methods to facilitate the creation of mocks of the main classes of [Laravel][laravel].    

#### Factory methods
- `newMock($whatToMock = null)`: returns an instance of `$whatToMock` or of `Mockery\MockInterface` if the argument value is _null_.
- `newAppMock()`: returns an instance of `Illuminate\Contracts\Foundation\Application`.
- `newConfigMock()`: returns an instance of `Illuminate\Contracts\Config\Repository`.
- `newFunctionMock(string $functionName)`: should be used to create a mock of a function, it returns an instance of `Mockery\CompositeExpectation`.

As the mock engine behind the scene is [Mockery][mockery], all these instances implement the `Mockery\MockInterface` or `Mockery\ExpectationInterface` and then can be enhanced with expectations.

#### Other methods
- `releaseMocks()`: releases all the mocks, does some cleanup.
- `useFunction(string $functionName, ...$args)`: static method to call as the body of a mocked function _(see [MockProviderTest][mockprovidertest]::testMockingFunctions() for an example on how to do this)_.

>Note:    
>While extending the `TestCase` abstract class, the `releaseMocks` method is 
>automatically called at the end of each test in the `tearDown` method.    
>If you intend to use the `MockProvider` trait directly, it is important
>to note that you will need to call the `releaseMocks` method by yourself.

License
-------
This project is licensed under the terms of the [MIT License](/LICENSE)

[laravel]: https://laravel.com/
[mockery]: http://docs.mockery.io/en/stable/
[mockprovidertest]: /tests/unit/Traits/MockProviderTest.php
