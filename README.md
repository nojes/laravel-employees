# Laravel Employee

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)

This package for employee management on Laravel Framework.

## Installation

Via Composer

```bash
$ composer require nojes/laravel-employee
```

If you do not run Laravel 5.5 (or higher), then add the service provider in `config/app.php`:

```php
nojes\employee\EmployeeServiceProvider::class,
```

If you do run the package on Laravel 5.5+, [package auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518) takes care of the magic of adding the service provider.

Optional you can publish the configuration to provide an own service provider stub.

```bash
$ php artisan vendor:publish --provider="nojes\employee\EmployeeServiceProvider"
```

## License

The BSD 3-Clause License (BSD-3-Clause). Please see [License File](LICENSE) for more information.


[ico-version]: https://poser.pugx.org/nojes/laravel-employee/v/stable
[ico-license]: https://poser.pugx.org/nojes/laravel-employee/license

[link-packagist]: https://packagist.org/packages/nojes/employee