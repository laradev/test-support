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

License
-------
This project is licensed under the terms of the [MIT License](/LICENSE)
