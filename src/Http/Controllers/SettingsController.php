<?php

namespace StarfolkSoftware\Kalibrant\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use StarfolkSoftware\Kalibrant\Actions\SaveSettings;

class SettingsController extends Controller
{
    /**
     * Updates the settings.
     *
     * @param  \StarfolkSoftware\Kalibrant\Actions\SaveSettings  $saveSettings
     * @param  string  $group
     * @param  mixed  $id
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function update(SaveSettings $saveSettings, string $group, $id)
    {
        $settingsClass = config('kalibrant.groups.' . $group);

        if (! $settingsClass) {
            throw new \InvalidArgumentException("The settings group [{$group}] does not exist.");
        }

        $settings = new $settingsClass($id);

        $saveSettings($settings, request()->all());

        if (request()->expectsJson()) {
            return response()->json([
                'settings' => $settings->toArray(),
            ]);
        }

        if ($settings->redirectRoute) {
            return Redirect::route($settings->redirectRoute);
        }

        return Redirect::back();
    }
}
