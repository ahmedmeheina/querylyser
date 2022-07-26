# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ameheina/querylyser.svg?style=flat-square)](https://packagist.org/packages/ameheina/querylyser)
[![Total Downloads](https://img.shields.io/packagist/dt/ameheina/querylyser.svg?style=flat-square)](https://packagist.org/packages/ameheina/querylyser)
![GitHub Actions](https://github.com/ameheina/querylyser/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require ameheina/querylyser
php artisan migrate
```

## Usage

To start listening to queries
```php
php artisan querylyser:start
```
To stop listening to queries && analyse results
```php
php artisan querylyser:stop
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ahmedmeheina@gmail.com instead of using the issue tracker.

## Credits

-   [Ahmed Meheina](https://github.com/ameheina)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
