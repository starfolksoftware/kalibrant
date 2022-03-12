<?php

use Illuminate\Support\Facades\Route;
use StarfolkSoftware\Setting\Http\Controllers\SettingsController;

Route::controller(SettingsController::class)->group(function () {
    Route::put('settings/{group}/{id}', 'SettingsController@update')->name('settings.update');
});
