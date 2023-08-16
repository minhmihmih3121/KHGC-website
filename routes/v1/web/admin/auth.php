<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login.show-form');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::get('password-confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('admin.password.show_confirm_form');
Route::post('password-confirm', [ConfirmPasswordController::class, 'confirm'])->name('admin.password.confirm');
