<?php

namespace StarfolkSoftware\Setting\Http\Controllers;

use StarfolkSoftware\Setting\Actions\SaveSettings;

class SettingsController extends Controller
{
    /**
     * Updates the settings.
     * 
     * @param  \StarfolkSoftware\Setting\Actions\SaveSettings  $saveSettings
     * @param  string  $group
     * @param  mixed  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveSettings $saveSettings, string $group, $id)
    {
        $settingsClass = config('setting.groups.' . $group);

        if (! $settingsClass) {
            throw new \InvalidArgumentException("The settings group [{$group}] does not exist.");
        }

        $settings = new $settingsClass($id);

        $saveSettings($settings, request()->all());

        return redirect()->back();
    }
}