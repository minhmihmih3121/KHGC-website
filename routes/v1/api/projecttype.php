<?php

use App\Http\Controllers\Api\ProjectTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('project-type')
->controller(ProjectTypeController::class)
->name('project_type.')
->group(function () {
Route::get('/', 'index')->name('index');
});
