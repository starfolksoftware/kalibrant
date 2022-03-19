<?php

namespace StarfolkSoftware\Kalibrant;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Kalibrant\Actions\SaveSettings;
use StarfolkSoftware\Kalibrant\Commands\SettingsMakeCommand;
use StarfolkSoftware\Kalibrant\Contracts\SavesSettings;

class KalibrantServiceProvider extends PackageServiceProvider
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
            ->name('kalibrant')
            ->hasConfigFile('kalibrant')
            ->hasCommand(SettingsMakeCommand::class)
            ->hasRoute('web');

        if (Setting::$shouldRunMigrations) {
            $package->hasMigration('create_settings_table');
        }
    }
}
