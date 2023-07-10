<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Customer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

//Routing Autentikasi
Route::middleware('loggedin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login.index');
    Route::post('login', [AuthController::class, 'login'])->name('login.check');
    Route::get('register', [AuthController::class, 'registerView'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');
});

//Routing User
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/product', ProductController::class);
    Route::get('/', [AdminController::class, 'dashboardAdmin'])->name('dashboard');
    Route::resource('/product', ProductController::class);
    Route::resource('/rental', RentalController::class);
    Route::resource('/payment', PaymentController::class);
    Route::resource('/retur', ReturController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/user', UserController::class);
});
