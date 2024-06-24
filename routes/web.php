<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;

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
        return view('pages.payroll.index');
    });
    
});


// Route::resource('inventory', [InventoryController::class]);

Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index']);
    Route::get('/create', [InventoryController::class, 'create']);
    Route::post('/', [InventoryController::class, 'store']);
    Route::get('/{inventory}', [InventoryController::class, 'show']);
    Route::get('/{id}/edit', [InventoryController::class, 'edit']);
    Route::post('/{id}/order', [InventoryController::class, 'order']);
    Route::put('/{id}', [InventoryController::class, 'update']);
    Route::delete('/{id}', [InventoryController::class, 'destroy']);
});

Route::prefix('suppliers')->group(function(){
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
});