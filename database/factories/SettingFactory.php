<?php

namespace StarfolkSoftware\Kalibrant\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use StarfolkSoftware\Kalibrant\Setting;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'setable_id' => $this->faker->numberBetween(1, 10),
            'setable_type' => $this->faker->randomElement(['App\Models\User', 'App\Models\Post']),
            'group' => $this->faker->word,
            'key' => $this->faker->word,
            'value' => $this->faker->word,
        ];
    }
}
