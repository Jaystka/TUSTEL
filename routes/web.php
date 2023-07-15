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
use App\Http\Controllers\ReturController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rental;
use App\Models\Retur;

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
    Route::get('/paginate', [AdminController::class, 'paginationHome']);
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/product/print', [ProductController::class, 'print_pdf'])->name('product.print');
    Route::get('/rental/print', [RentalController::class, 'print_pdf'])->name('rental.print');
    Route::get('/payment/print', [PaymentController::class, 'print_pdf'])->name('payment.print');
    Route::get('/retur/print', [ReturController::class, 'print_pdf'])->name('retur.print');
    Route::get('/customer/print', [CustomerController::class, 'print_pdf'])->name('customer.print');
    Route::resource('/product', ProductController::class);
    Route::resource('/rental', RentalController::class);
    Route::resource('/payment', PaymentController::class);
    Route::resource('/retur', ReturController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/user', UserController::class);
});
