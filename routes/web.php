<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/superadmin', function () {
    return view('superadmin.index');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, '__invoke'])->name('authenticate');
Route::post('/logout', LogoutController::class)->name('logout');

// Manajemen routing user
Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'superadmin']], function() {
    Route::resource('/dashboard', UserController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    // Routes for assigning and deleting roles for users
    Route::post('users/assign-roles', [RoleController::class, 'storeRole'])->name('roles.storeRole');
    Route::delete('users/{user}/remove-role/{role}', [RoleController::class, 'removeUserRole'])->name('roles.removeUserRole');
    
    // Routes for editing and updating user roles
    Route::get('users/{user}/edit-roles', [RoleController::class, 'editUserRole'])->name('roles.editUserRole');
    Route::post('users/{user}/update-roles', [RoleController::class, 'updateUserRole'])->name('roles.updateUserRole');

    // Permission routes
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Routes for assigning permissions to roles
    Route::post('permissions/assign-permissions', [PermissionController::class, 'assignPermissions'])->name('permissions.assignPermissions');
    Route::delete('permissions/remove-permissions/{role}', [PermissionController::class, 'removePermissions'])->name('permissions.removePermissions');

    // Routes for editing and updating role permissions
    Route::get('roles/{role}/edit-permissions', [RoleController::class, 'editPermissions'])->name('roles.editPermissions');
    Route::post('roles/{role}/update-permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');
});
