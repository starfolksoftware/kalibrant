<p align="center"><img width="200" src="https://user-images.githubusercontent.com/4984175/159135103-4eda743a-5928-4eb2-a674-939cb518bff3.png" alt="Logo Kalibrant"></p>

<p align="center">
    <a href="https://github.com/starfolksoftware/kalibrant/actions">
        <img src="https://github.com/starfolksoftware/kalibrant/actions/workflows/run-tests.yml/badge.svg" alt="Build Status">
    </a>
    <a href="https://github.com/starfolksoftware/kalibrant/actions">
        <img src="https://github.com/starfolksoftware/kalibrant/actions/workflows/php-cs-fixer.yml/badge.svg" alt="Build Status">
    </a>
    <a href="https://github.com/starfolksoftware/kalibrant/actions">
        <img src="https://github.com/starfolksoftware/kalibrant/actions/workflows/phpstan.yml/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/starfolksoftware/kalibrant">
        <img src="https://img.shields.io/packagist/dt/starfolksoftware/kalibrant" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/starfolksoftware/kalibrant">
        <img src="https://img.shields.io/packagist/v/starfolksoftware/kalibrant" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/starfolksoftware/kalibrant">
        <img src="https://img.shields.io/packagist/l/starfolksoftware/kalibrant" alt="License">
    </a>
</p>

# Introduction

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

Add the `HasSetting` trait to your model:

```php
<?php

namespace App\Models;

use StarfolkSoftware\Kalibrant\HasSettings;

class User extends Authenticatable
{
    use HasSetting;
}
```

You can create a new setting file by running the following command from the terminal:

```bash
php artisan make:setting AutopilotSettings
```

This is will create a new file in the `/app/Settings/` directory. Here is a sample file:

```php
<?php

namespace App\Settings;

use App\Models\User;
use StarfolkSoftware\Kalibrant\Settings;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutopilotSettings extends Settings
{
    /**
     * The route to redirect to after update.
     * 
     * @var mixed
     */
    public $redirectRoute = 'profile.show';

    /**
     * Constructor.
     *
     * @param mixed $id
     * @return void
     */
    public function __construct(
        protected $id
    )
    {
        parent::__construct();
    }

    /**
     * Configure the settings attributes
     * 
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureAttributes(OptionsResolver $resolver)
    {
        $resolver->define('enabled')
            ->default(false)
            ->allowedTypes('boolean')
            ->info('Whether autopilot is enabled');
        
        $resolver->define('channels')
            ->default(['twitter'])
            ->allowedTypes('array')
            ->info('The channels to autopilot');

        $resolver->define('tweet_freq')
           ->default(60)
           ->allowedTypes('integer', 'string')
           ->info('Tweets count every hour.');

        $resolver->define('retweet_freq')
            ->default(15)
            ->allowedTypes('integer', 'string')
            ->info('Number of retweets in an hour');

        $resolver->define('like_freq')
            ->default(15)
            ->allowedTypes('integer', 'string')
            ->info('Number of likes in an hour');

        $resolver->define('follow_freq')
            ->default(15)
            ->allowedTypes('integer', 'string') 
            ->info('Number of follows in an hour');
            
        $resolver->define('hashtags')
            ->default(['#programming', '#dev'])
            ->allowedTypes('array')
            ->info('Relavant hashtags.');
    }

    /**
     * Returns the setable type
     * 
     * @return string
     */
    public static function setableType()
    {
        return User::class;
    }

    /**
     * Returns the setable id
     * 
     * @return int
     */
    public function setableId()
    {
        return $this->id;
    }

    /**
     * Return the settings group
     * 
     * @return string
     */
    public static function group()
    {
        return 'autopilot-settings';
    }

    /**
     * Validation rules.
     * 
     * @return array
     */
    public function rules(): array
    {
        return [
            'enabled' => ['required', 'boolean'],
            'channels' => ['required', 'array'],
            'channels.*' => ['required', 'string', 'in:twitter,facebook,instagram,linkedin'],
            'tweet_freq' => ['required', 'integer', 'max:12'],
            'retweet_freq' => ['required', 'integer', 'max:12'],
            'like_freq' => ['required', 'integer', 'max:12'],
            'follow_freq' => ['required', 'integer', 'max:12'],
            'hashtags' => ['required', 'array'],
            'hashtags.*' => ['required', 'string'],
        ];
    }
}
```

To update the settings, make a `PUT` request to `route('settings.update', ['group' => '..', 'id' => '...'])` with the defined attributes as data. A sample request to update the above settings:

```php
<?php

    $response = $this->putJson(route('settings.update', ['group' => 'autopilot-settings', 'id' => $user->id]), [
        'enabled' => true,
        'channels' => ['twitter', 'facebook'],
        'tweet_freq' => '60',
        'retweet_freq' => '15',
        'like_freq' => '15',
        'follow_freq' => '15',
        'hashtags' => ['#programming', '#dev'],
    ]);
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
