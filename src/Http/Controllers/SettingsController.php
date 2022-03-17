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
     * @return mixed
     */
    public function update(SaveSettings $saveSettings, string $group, $id)
    {
        $settingsClass = config('setting.groups.' . $group);

        if (! $settingsClass) {
            throw new \InvalidArgumentException("The settings group [{$group}] does not exist.");
        }

        $settings = new $settingsClass($id);

        $saveSettings($settings, request()->all());

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Settings saved.',
            ]);
        }

        if (config('setting.renderer') === 'inertia') {
            return inertia(config('setting.component'), [
                'message' => 'Settings saved.',
            ]);
        }

        return redirect()->back()->with('message', 'Settings saved.');
    }
}