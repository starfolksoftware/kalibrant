<?php

use StarfolkSoftware\Setting\Actions\SaveSettings;
use StarfolkSoftware\Setting\Tests\Mocks\TestUser;

it('can retrieve a model\'s settings', function () {
    $user = TestUser::first();

    $settings = $user->settingsForGroup('test-settings');

    expect($settings->attribute1)->toBe('value1');
    expect($settings->attribute2)->toBe('value2');
});

it('can update a model\'s settings', function () {
    $user = TestUser::first();

    $settings = $user->settingsForGroup('test-settings');

    $settings->attribute1 = 'new value';
    $settings->attribute2 = 'new value';

    $settings->save();

    $settings = $user->settingsForGroup('test-settings');

    expect($settings->attribute1)->toBe('new value');
    expect($settings->attribute2)->toBe('new value');
});
