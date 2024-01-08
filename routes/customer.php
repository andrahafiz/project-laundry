<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\UserController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\TransactionController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(ProductController::class)->group(
    function () {
        Route::get('/produk',  'index')->name('produk.index');
        Route::get('/produk/tambah-produk',  'create')->name('produk.tambah-produk');
        Route::post('/produk/tambah-produk/store',  'store')->name('produk.store');
        Route::get('/produk/detail-produk/{product}',  'show')->name('produk.detail');
        Route::get('/produk/edit-produk/{product}',  'edit')->name('produk.edit-produk');
        Route::put('/produk/edit-produk/update/{product}',  'update')->name('produk.update');
        Route::delete('/produk/hapus-produk/{product}',  'destroy')->name('produk.destroy');
    }
);

Route::controller(CategoryController::class)->group(
    function () {
        Route::get('/kategori-produk', 'index')->name('kategori-produk.index');
        Route::get('/kategori-produk/tambah-kategori-produk',  'create')->name('kategori-produk.tambah-kategori-produk');
        Route::post('/kategori-produk/tambah-kategori-produk/store',  'store')->name('kategori-produk.store');
        Route::get('/kategori-produk/edit-kategori-produk/{category}',  'edit')->name('kategori-produk.edit');
        Route::put('/kategori-produk/edit-kategori-produk/update/{category}',  'update')->name('kategori-produk.update');
        Route::delete('/kategori-produk/hapus-kategori-produk/{category}',  'destroy')->name('kategori-produk.destroy');
    }
);

Route::controller(UserController::class)->group(
    function () {
        Route::get('/user', 'index')->name('user.index');
        Route::put('/user/edit-user/update/{user}',  'update')->name('user.update');
    }
);

Route::controller(KasirController::class)->group(
    function () {
        Route::get('/kasir', 'index')->name('kasir.index');
        Route::get('/buktitransfer/{transaction}', 'buktitransfer')->name('buktitransfer');
        Route::put('/buktitransfer/{transaction}',  'uploadbuktitransfer')->name('uploadbuktitransfer');
    }
);

Route::controller(CartController::class)->group(
    function () {
        Route::post('/masukan-keranjang', 'store')->name('cart.add-to-cart');
        Route::get('/keranjang', 'index')->name('cart.index');
        Route::patch('/keranjang/{cart}/update-stock', 'updateStock')->name('cart.put');
        Route::delete('/keranjang/{cart}', 'destroy')->name('cart.destroy');
    }
);
Route::controller(TransactionController::class)->group(
    function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/invoice/{transaction}', 'invoice')->name('invoice');
        Route::delete('/transaksi/{transaction}/destroy', 'destroy')->name('transaksi.destory');
    }
);
Route::controller(InvoiceController::class)->group(
    function () {
        Route::get('/invoice/{transaction}', 'invoice')->name('invoice');
        Route::get('/invoice/{transaction}/print', 'print_invoice')->name('invoice.print');
    }
);
Route::controller(CheckoutController::class)->group(
    function () {
        Route::post('/checkout', 'store')->name('checkout.store');
    }
);
Route::fallback(function () {
    return view('errors.404');
});
