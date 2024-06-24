<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PayrollAbsenceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollSalaryController;
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


Route::prefix('inventory')->group(function () {
    Route::get('/', function () {
        return view('pages.inventory.index');
    });
});