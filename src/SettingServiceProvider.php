<?php

namespace StarfolkSoftware\Setting;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Setting\Commands\CreateSettingCommand;

class SettingServiceProvider extends PackageServiceProvider
{
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
            ->hasCommand(CreateSettingCommand::class)
            ->hasMigration('create_settings_table');
    }
}
