<p align="center"><img src="/art/logo.svg" alt="Logo Kalibrant"></p>

<p align="center">
    <a href="https://github.com/laravel/jetstream/actions">
        <img src="https://github.com/laravel/jetstream/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://img.shields.io/packagist/dt/laravel/jetstream" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://img.shields.io/packagist/v/laravel/jetstream" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://img.shields.io/packagist/l/laravel/jetstream" alt="License">
    </a>
</p>

# Introduction

[![Latest Version on Packagist](https://img.shields.io/packagist/v/starfolk-software/kalibrant.svg?style=flat-square)](https://packagist.org/packages/starfolk-software/kalibrant)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/starfolk-software/kalibrant/run-tests?label=tests)](https://github.com/starfolk-software/kalibrant/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/starfolk-software/kalibrant/Check%20&%20fix%20styling?label=code%20style)](https://github.com/starfolk-software/kalibrant/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/starfolk-software/kalibrant.svg?style=flat-square)](https://packagist.org/packages/starfolk-software/kalibrant)

For your laravel 9.x applications, `Kalibrant` is a package that provides a simple way to manage your models settings. It is a simple way to manage your user and team models settings.

## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/kalibrant
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="kalibrant-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="kalibrant-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * Define all the settings groups.
     */
    'groups' => [
        // 'setting-group' => SettingGroup::class,
    ],

    'middleware' => ['web'],
];
```

## Usage

```php

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Faruk Nasir](https://github.com/starfolksoftware)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
