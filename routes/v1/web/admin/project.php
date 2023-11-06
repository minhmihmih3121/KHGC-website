<?php

use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::resource('project',ProjectController::class)->names('project');

Route::controller(ProjectController::class)->prefix('project')->name('project.')
    ->group(function () {
        Route::put('toggle-status/{project}', 'toggleStatus')->name('toggle_status');
    });
