<?php

use StarfolkSoftware\Kalibrant\Tests\Mocks\TestUser;

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

    expect($settings->attribute1)->toBe('new value');
    expect($settings->attribute2)->toBe('new value');
});

it('can update a setting over http request', function () {
    $user = TestUser::first();

    $response = actingAs($user)->put(route('settings.update', [
        'group' => 'test-settings',
        'id' => $user->id,
    ]), [
        'attribute1' => 'new value',
        'attribute2' => 'new value',
    ]);

    expect($response->status())->toBe(302);
});

it('throws an exception when trying to update a setting not in the config file', function () {
    $user = TestUser::first();

    config()->set('setting.groups', []);

    $response = actingAs($user)->put(route('settings.update', [
        'group' => 'test-settings',
        'id' => $user->id,
    ]), [
        'attribute1' => 'new value',
        'attribute2' => 'new value',
    ]);

    expect($response->status())->toBe(500);
});

test('that trying to access settings not in the config file throws exception', function () {
    $user = TestUser::first();

    $this->expectException(\InvalidArgumentException::class);

    $user->settingsForGroup('not-in-config');
});

test('that json response is received when it is expected', function () {
    $user = TestUser::first();

    $response = actingAs($user)->putJson(route('settings.update', [
        'group' => 'test-settings',
        'id' => $user->id,
    ]), [
        'attribute1' => 'new value',
        'attribute2' => 'new value',
    ]);

    expect($response->status())->toBe(200);
    expect($response->json('settings.attribute1'))->toBe('new value');
    expect($response->json('settings.attribute2'))->toBe('new value');
});

it('can redirect to set route', function () {
    $user = TestUser::first();

    $response = actingAs($user)->put(route('settings.update', [
        'group' => 'test-settings-with-redirect',
        'id' => $user->id,
    ]), [
        'attribute1' => 'new value',
        'attribute2' => 'new value',
    ]);

    expect($response->status())->toBe(302);
    expect($response->headers->get('Location'))->toBe(route('settings.show'));
});
