<?php

use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::resource('banner', BannerController::class)->names('banner');

Route::controller(BannerController::class)->prefix('banner')->name('banner.')
    ->group(function () {
        Route::put('toggle-status/{banner}', 'toggleStatus')->name('toggle_status');
    });
