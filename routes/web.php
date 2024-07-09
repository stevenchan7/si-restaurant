<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PayrollSalaryController;
use App\Http\Controllers\PayrollAbsenceController;

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
Route::get('/liatcomponen', function () {
    return view('components.layouts.admin-layout');
});

Route::middleware('auth')->prefix('/notifications')->group(function () {
    Route::get('/markAsRead/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
});

Route::get('/', function () {
    // return view('welcome');
    return view('components.layouts.admin-layout');
});

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', LoginController::class)->name('authenticate');
Route::post('/logout', LogoutController::class)->name('logout');

// Payroll
Route::middleware('auth')->prefix('payroll')->group(function () {
    Route::get('/', [PayrollController::class, 'index'])->name('payroll');
    Route::get('/payroll', [PayrollController::class, 'getPayrollData'])->name('payroll.get');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.post');
    Route::get('/absence', [PayrollAbsenceController::class, 'index'])->name('payroll.absence');
    Route::post('/overtime', [PayrollAbsenceController::class, 'storeOvertime'])->name('overtime.post');
    Route::delete('/overtime', [PayrollAbsenceController::class, 'destroyOvertime'])->name('overtime.delete');
    Route::post('/dayoff', [PayrollAbsenceController::class, 'storeDayoff'])->name('dayoff.post');
    Route::delete('/dayoff', [PayrollAbsenceController::class, 'destroyDayoff'])->name('dayoff.delete');
    Route::get('/salary', [PayrollSalaryController::class, 'index'])->name('payroll.salary');
    // Route::post('/salary', function () {
    //     return response()->json(['msg' => 'hello world']);
    // })->name('salary.post');
    Route::post('/salary', [PayrollSalaryController::class, 'store'])->name('salary.post');
    Route::put('/salary', [PayrollSalaryController::class, 'update'])->name('salary.update');
    Route::delete('/salary', [PayrollSalaryController::class, 'destroy'])->name('salary.delete');
});

// Token
Route::get('/token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});



Route::middleware('auth')->prefix('/inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index']);
    Route::get('/create', [InventoryController::class, 'create']);
    Route::post('/', [InventoryController::class, 'store']);
    Route::get('/{inventory}', [InventoryController::class, 'show'])->name('inventory.show');
    Route::get('/{id}/edit', [InventoryController::class, 'edit']);
    Route::post('/{id}/order', [InventoryController::class, 'order']);
    Route::put('/{id}', [InventoryController::class, 'update']);
    Route::delete('/{id}', [InventoryController::class, 'destroy']);
});

Route::middleware('auth')->get('/orderLog', [InventoryController::class, 'showLogs']);
// Route::middleware('auth')->prefix('inventory')->group(function () {
//     Route::get('/', [InventoryController::class, 'index']);
//     Route::get('/create', [InventoryController::class, 'create']);
//     Route::get('/log', [InventoryController::class, 'showLogs']);
//     Route::post('/', [InventoryController::class, 'store']);
//     Route::get('/{inventory}', [InventoryController::class, 'show']);
//     Route::get('/{id}/edit', [InventoryController::class, 'edit']);
//     Route::post('/{id}/order', [InventoryController::class, 'order']);
//     Route::put('/{id}', [InventoryController::class, 'update']);
//     Route::delete('/{id}', [InventoryController::class, 'destroy']);
// });

// Route::middleware('auth')->prefix('suppliers')->group(function(){
//     Route::get('/', [SupplierController::class, 'index']);
//     Route::get('/create', [SupplierController::class, 'create']);
//     Route::post('/', [SupplierController::class, 'store']);
//     Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
//     Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
//     Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
//     Route::get('/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
// });

Route::prefix('suppliers')->group(function(){
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
});

