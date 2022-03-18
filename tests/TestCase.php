<?php

namespace StarfolkSoftware\Setting\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use StarfolkSoftware\Setting\SettingServiceProvider;
use StarfolkSoftware\Setting\Tests\Mocks\TestSettings;
use StarfolkSoftware\Setting\Tests\Mocks\TestSettingsWithRedirect;
use StarfolkSoftware\Setting\Tests\Mocks\TestUser;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'StarfolkSoftware\\Setting\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->loadLaravelMigrations(['--database' => 'sqlite']);
        $this->createUser();
    }

    protected function getPackageProviders($app)
    {
        return [
            SettingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('auth.providers.users.model', TestUser::class);
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        config()->set('app.key', 'base64:6Cu/ozj4gPtIjmXjr8EdVnGFNsdRqZfHfVjQkmTlg4Y=');

        config()->set('setting.groups.test-settings', TestSettings::class);
        config()->set('setting.groups.test-settings-with-redirect', TestSettingsWithRedirect::class);

        $migration = include __DIR__.'/../database/migrations/create_settings_table.php.stub';
        $migration->up();
    }

    protected function createUser()
    {
        TestUser::forceCreate([
            'name' => 'Faruk Nasir',
            'email' => 'faruk@starfolksoftware.com',
            'password' => 'test'
        ]);
    }
}
