<?php

use App\Http\Controllers\Api\SectionController;
use Illuminate\Support\Facades\Route;

Route::prefix('section')
    ->controller(SectionController::class)
    ->name('section.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
});