<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', LoginController::class)->name('authenticate');
Route::post('/logout', LogoutController::class)->name('logout');

// Payroll
Route::prefix('payroll')->group(function () {
    Route::get('/', function () {
        Route::get('/', [InventoryController::class, 'index']);
    });
});


Route::prefix('inventory')->group(function () {
    Route::get('/', function () {
        return view('pages.inventory.index');
    });
});