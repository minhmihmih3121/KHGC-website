<?php

use App\Http\Controllers\Api\BannerController;
use Illuminate\Support\Facades\Route;

Route::prefix('banner')
    ->controller(BannerController::class)
    ->name('banner.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{banner}', 'show')->name('index');
});