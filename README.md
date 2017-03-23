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

### MockProvider
The `MockProvider` trait offers a set of factory methods to facilitate the creation of mocks of the main classes of [Laravel][laravel].    
- _newAppMock_: returns an instance of `Illuminate\Contracts\Foundation\Application`
- _newConfigMock_: returns an instance of `Illuminate\Contracts\Config\Repository`

As the mock engine behind the scene is [Mockery][mockery], all these instances implement the `Mockery\MockInterface` and then can be enhanced with expectations.

The `MockProvider` class has also an important method named `releaseMocks` that is automatically called at the end of each test.    
This method as indicated by its explicit name, release all the mocks.

>Note:    
>In case the `MockProvider` trait is used directly, it is important to note
>that you need to call the `releaseMocks` method by yourself.

License
-------
This project is licensed under the terms of the [MIT License](/LICENSE)

[laravel]: https://laravel.com/
[mockery]: http://docs.mockery.io/en/stable/