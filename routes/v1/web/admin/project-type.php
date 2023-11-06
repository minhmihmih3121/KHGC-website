<?php

use App\Http\Controllers\Admin\ProjectTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('project-type',ProjectTypeController::class)->names('project_type');

