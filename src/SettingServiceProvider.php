<?php

namespace StarfolkSoftware\Setting;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Setting\Actions\SaveSettings;
use StarfolkSoftware\Setting\Commands\SettingsMakeCommand;
use StarfolkSoftware\Setting\Contracts\SavesSettings;

class SettingServiceProvider extends PackageServiceProvider
{
    public array $bindings = [
        SavesSettings::class => SaveSettings::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-setting')
            ->hasConfigFile()
            ->hasCommand(SettingsMakeCommand::class)
            ->hasMigration('create_settings_table')
            ->hasRoute('web');
    }
}
