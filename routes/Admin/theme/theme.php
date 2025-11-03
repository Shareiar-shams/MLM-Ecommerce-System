<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ThemeSetting\ThemeSettingsController;

Route::controller(ThemeSettingsController::class)->group( function () {
    Route::post('/theme-settings', 'store')->name('theme.store');
    Route::get('/theme-settings', 'get')->name('theme.get');
});
