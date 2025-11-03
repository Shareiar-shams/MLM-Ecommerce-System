<?php

use App\Http\Controllers\Admin\Localization\LocalizationController;
use Illuminate\Support\Facades\Route;


/* ==============================================
===============< Localization Routes >==============
===============================================*/
Route::get('localization/{lang}', LocalizationController::class)->name('localization');