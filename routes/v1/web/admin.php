<?php

use App\Acl\Acl;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    include('admin/auth.php');

    Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF . '|' . Acl::PERMISSION_VIEW_MENU_ADMIN])
        ->name('admin.')
        ->group(function () {
        include('admin/dashboard.php');
        include('admin/section.php');
        include('admin/banner.php');
    });
});
