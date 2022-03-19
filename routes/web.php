<?php

use Illuminate\Support\Facades\Route;
use StarfolkSoftware\Kalibrant\Http\Controllers\SettingsController;

Route::group([
    'middleware' => config('kalibrant.middleware', ['web']),
], function () {
    Route::controller(SettingsController::class)->group(function () {
        Route::put('settings/{group}/{id}', 'update')->name('settings.update');
    
        if (app()->runningInConsole()) {
            Route::get('settings', function () {
                // This is for testing purposes only.
            })->name('settings.show');
        }
    });
});
