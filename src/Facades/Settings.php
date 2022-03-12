<?php

namespace StarfolkSoftware\Settings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Settings\Settings
 */
class Settings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-settings';
    }
}
