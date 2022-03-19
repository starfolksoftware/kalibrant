<?php

namespace StarfolkSoftware\Kalibrant\Contracts;

use StarfolkSoftware\Kalibrant\Settings;

interface SavesSettings
{
    /**
     * Save the settings.
     * 
     * @param  \StarfolkSoftware\Kalibrant\Settings  $settings
     * @param  array  $data
     * @return void
     */
    public function __invoke(Settings $settings, array $data): void;
}