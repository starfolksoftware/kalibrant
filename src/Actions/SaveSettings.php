<?php

namespace StarfolkSoftware\Setting\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Setting\Contracts\SavesSettings;
use StarfolkSoftware\Setting\Settings;

class SaveSettings implements SavesSettings
{
    /**
     * Save the settings.
     * 
     * @param  \StarfolkSoftware\Setting\Settings  $settings
     * @param  array  $data
     * @return void
     */
    public function __invoke(Settings $settings, array $data): void
    {
        Validator::make($data, $settings->rules())->validate();

        $definedKeys = $settings->getResolver()->getDefinedOptions();

        $settings->fill(
            collect($data)->only($definedKeys)->toArray()
        )->save();
    }
}
