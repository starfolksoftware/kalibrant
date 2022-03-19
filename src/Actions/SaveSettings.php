<?php

namespace StarfolkSoftware\Kalibrant\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Kalibrant\Contracts\SavesSettings;
use StarfolkSoftware\Kalibrant\Settings;

class SaveSettings implements SavesSettings
{
    /**
     * Save the settings.
     *
     * @param  \StarfolkSoftware\Kalibrant\Settings  $settings
     * @param  array  $data
     * @return void
     */
    public function __invoke(Settings $settings, array $data): void
    {
        Validator::make($data, $settings->rules())->validateWithBag('updateSettings');

        $definedKeys = $settings->getResolver()->getDefinedOptions();

        $settings->fill(
            collect($data)->only($definedKeys)->toArray()
        )->save();
    }
}
