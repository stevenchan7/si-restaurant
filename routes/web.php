<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
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
//manajemen routing user role
Route::group(['prefix'=>'admin','middleware' => ['auth', 'role:1']],function(){
   Route::resource('/dashboard', AdminController::class);
});
Route::group(['prefix'=>'customer','middleware' => ['auth', 'role:2']],function(){
    Route::resource('/dashboard', AdminController::class);
});

Route::group(['prefix'=>'pegawai','middleware' => ['auth', 'role:3']],function(){
    Route::resource('/dashboard', AdminController::class);
});
//end manajemen routing user role

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware('auth');

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

Route::get('/order', [OrderController::class,'index'])->name('order');
Route::get('/order/menu/{id}', [MenuController::class, 'index'])->name('menu_selection');
Route::get('/order/{id}/payment', [PaymentController::class,'index'])->name('payment');
Route::post('/order/create', [OrderController::class,'store'])->name('order.create');
Route::post('/order/menu/{id}/add',[MenuController::class,'store'])->name('menu.add');
Route::post('/order/{id}/payment/action',[PaymentController::class,'update'])->name('payment_action');
