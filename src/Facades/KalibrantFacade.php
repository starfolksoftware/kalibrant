<?php

namespace StarfolkSoftware\Kalibrant\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Kalibrant\Setting
 */
class KalibrantFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kalibrant';
    }
}
