<?php

namespace StarfolkSoftware\Setting\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Setting\Setting
 */
class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kalibrant';
    }
}
