<?php

use Illuminate\Support\Facades\Route;
use StarfolkSoftware\Setting\Http\Controllers\SettingsController;

Route::controller(SettingsController::class)->group(function () {
    Route::put('settings/{group}/{id}', 'update')->name('settings.update');
});
