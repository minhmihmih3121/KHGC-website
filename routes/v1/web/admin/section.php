<?php

use App\Http\Controllers\Admin\SectionController;
use Illuminate\Support\Facades\Route;

Route::resource('section', SectionController::class)->names('section');

Route::controller(SectionController::class)->prefix('section')->name('section.')
    ->group(function () {
        Route::put('toggle-status/{section}', 'toggleStatus')->name('toggle_status');
    });
