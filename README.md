# Laravel Employees

[![Latest Version on Packagist][ico-version]][link-packagist]

This package for employees management on Laravel Framework.

## Installation

Via Composer

```
$ composer require nojes/laravel-employees
```

If you do not run Laravel 5.5 (or higher), then add the service provider in `config/app.php`:

```php
nojes\employees\EmployeesServiceProvider::class,
```

If you do run the package on Laravel 5.5+, just run:
```
$ php artisan employees:install
```

Optional you can publish the configuration to provide an own service provider stub.
([package auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518))

```
$ php artisan vendor:publish --provider="nojes\employees\EmployeesServiceProvider"
```

### Database seeding
If you want to have some example entries in the database, this command will seed models tables with test data:
```
$ php artisan db:seed --class="nojes\employees\database\seeds\EmployeesDatabaseSeeder"
```

or separately:

| Model    | Command                                                                                        |
|----------|------------------------------------------------------------------------------------------------|
| Employee | `$ php artisan db:seed --class="nojes\employees\database\seeds\EmployeeTableSeeder"`           |
| Position | `$ php artisan db:seed --class="nojes\employees\database\seeds\EmployeePositionTableSeeder"`   |


## License

[![Software License][ico-license]](LICENSE)

The BSD 3-Clause License (BSD-3-Clause). Please see [License File](LICENSE) for more information.


[ico-version]: https://poser.pugx.org/nojes/laravel-employees/v/stable
[ico-license]: https://poser.pugx.org/nojes/laravel-employees/license

[link-packagist]: https://packagist.org/packages/nojes/laravel-employees