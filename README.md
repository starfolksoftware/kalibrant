
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# A package to manage settings of your models.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/starfolk-software/laravel-settings.svg?style=flat-square)](https://packagist.org/packages/starfolk-software/laravel-settings)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/starfolk-software/laravel-settings/run-tests?label=tests)](https://github.com/starfolk-software/laravel-settings/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/starfolk-software/laravel-settings/Check%20&%20fix%20styling?label=code%20style)](https://github.com/starfolk-software/laravel-settings/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/starfolk-software/laravel-settings.svg?style=flat-square)](https://packagist.org/packages/starfolk-software/laravel-settings)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require starfolk-software/laravel-settings
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-settings-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-settings-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-settings-views"
```

## Usage

```php
$settings = new StarfolkSoftware\Settings();
echo $settings->echoPhrase('Hello, Starfolk Software!');
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
