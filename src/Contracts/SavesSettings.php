<?php

namespace StarfolkSoftware\Setting\Contracts;

use StarfolkSoftware\Setting\Settings;

interface SavesSettings
{
    /**
     * Save the settings.
     * 
     * @param  \StarfolkSoftware\Setting\Settings  $settings
     * @param  array  $data
     * @return void
     */
    public function __invoke(Settings $settings, array $data): void;
}