<?php

namespace StarfolkSoftware\Kalibrant;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasSettings
{
    /**
     * Get all of the model's settings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function settings()
    {
        return $this->morphMany(Setting::class, 'setable');
    }

    /**
     * Retrieves a group of settings.
     *
     * @param  string  $group
     * @return \StarfolkSoftware\Kalibrant\Settings
     */
    public function settingsForGroup(string $group)
    {
        $settingsClass = config('setting.groups.' . $group);

        if (! $settingsClass) {
            throw new \InvalidArgumentException("The settings group [{$group}] does not exist.");
        }

        return new $settingsClass($this->id);
    }

    /**
     * Scope a query to only include settings for the given setable type
     * of the model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $setableType
     * @return void
     */
    public function scopeForGroup(Builder $query, string $group)
    {
        $query->where('group', $group);
    }
}
