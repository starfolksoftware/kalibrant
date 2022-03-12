<?php

namespace StarfolkSoftware\Settings;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Settings\Commands\SettingsCommand;

class SettingsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-settings')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-settings_table')
            ->hasCommand(SettingsCommand::class);
    }
}
