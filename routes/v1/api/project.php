<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('project')
    ->controller(ProjectController::class)
    ->name('project.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{project}', 'show')->name('index');
});
