<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Laporan\CashFlowController;
use App\Http\Controllers\Admin\Laporan\ModalController;
use App\Http\Controllers\Admin\Laporan\ProfitLossController;
use App\Http\Controllers\CatatanTokoController;
use App\Http\Controllers\ReportController;

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


Route::middleware(['auth', 'checkRole:ADMIN'])->controller(ProductController::class)->group(
    function () {
        Route::get('/produk',  'index')->name('produk.index');
        Route::get('/produk/tambah-produk',  'create')->name('produk.tambah-produk');
        Route::post('/produk/tambah-produk/store',  'store')->name('produk.store');
        Route::get('/produk/detail-produk/{product}',  'show')->name('produk.detail');
        Route::get('/produk/detail-produk/{product}/api',  'show_api')->name('produk.detail_api');
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
        Route::get('/user/tambah-user',  'create')->name('user.tambah-user');
        Route::post('/user/tambah-user/store',  'store')->name('user.store');
        Route::get('/user/edit-user/{user}',  'edit')->name('user.edit');
        Route::put('/user/edit-user/update/{user}',  'update')->name('user.update');
        Route::delete('/user/hapus-user/{user}',  'destroy')->name('user.destroy');
    }
);

Route::controller(CatatanTokoController::class)->group(
    function () {
        Route::get('/catatantoko', 'index')->name('catatantoko.index');
        Route::get('/catatantoko/tambah-catatantoko',  'create')->name('catatantoko.tambah-catatantoko');
        Route::post('/catatantoko/tambah-catatantoko/store',  'store')->name('catatantoko.store');
        Route::get('/catatantoko/edit-catatantoko/{catatantoko}',  'edit')->name('catatantoko.edit');
        Route::put('/catatantoko/edit-catatantoko/update/{catatantoko}',  'update')->name('catatantoko.update');
        Route::delete('/catatantoko/hapus-catatantoko/{catatantoko}',  'destroy')->name('catatantoko.destroy');
    }
);

Route::controller(KasirController::class)->group(
    function () {
        Route::get('/kasir', 'index')->name('kasir.index');
    }
);

Route::controller(CartController::class)->group(
    function () {
        Route::post('/masukan-keranjang', 'store')->name('cart.add-to-cart');
        Route::get('/keranjang', 'index')->name('cart.index');
        Route::delete('/keranjang/{cart}', 'destroy')->name('cart.destroy');
        Route::patch('/keranjang/{cart}/update-stock', 'updateStock')->name('cart.put');
    }
);
Route::controller(TransactionController::class)->group(
    function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/transaksi/{transaction}', 'show')->name('transaksi.edit');
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
Route::controller(ReportController::class)->group(
    function () {
        Route::get('/laporan/transaksi', 'index')->name('laporan.transaksi');
        Route::get('/laporan/transaksi/print', 'print_transaksi')->name('laporan.transaksi.print');
    }
);
Route::controller(FeedbackController::class)->group(
    function () {
        Route::get('/feedback', 'index')->name('feedback.index');
        Route::put('/feedback/update/{feedback}', 'update')->name('feedback.update');
        Route::get('/feedback/detail/{feedback}',  'show')->name('feedback.show');
        Route::delete('/feedback/{feedback}',  'destroy')->name('feedback.destroy');
    }
);

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::controller(ModalController::class)->group(
        function () {
            Route::get('/modal/tambah', 'create')->name('modal.create');
            Route::post('/modal/tambah', 'store')->name('modal.store');
            Route::get('/modal', 'index')->name('modal.index');
            Route::get('/modal/edit/{modal}',  'edit')->name('modal.edit');
            Route::put('/modal/edit/{modal}', 'update')->name('modal.update');
            Route::delete('/modal/{modal}',  'destroy')->name('modal.destroy');
        }
    );
    Route::controller(CashFlowController::class)->group(
        function () {
            Route::get('/cashflow/tambah', 'create')->name('cashflow.create');
            Route::post('/cashflow/tambah', 'store')->name('cashflow.store');
            Route::get('/cashflow', 'index')->name('cashflow.index');
            Route::get('/cashflow/edit/{cashflow}',  'edit')->name('cashflow.edit');
            Route::put('/cashflow/edit/{cashflow}', 'update')->name('cashflow.update');
            Route::delete('/cashflow/{cashflow}',  'destroy')->name('cashflow.destroy');
        }
    );
    Route::controller(ProfitLossController::class)->group(
        function () {
            Route::get('/profitloss/tambah', 'create')->name('profitloss.create');
            Route::post('/profitloss/tambah', 'store')->name('profitloss.store');
            Route::get('/profitloss', 'index')->name('profitloss.index');
            Route::get('/profitloss/edit/{profitloss}',  'edit')->name('profitloss.edit');
            Route::put('/profitloss/edit/{profitloss}', 'update')->name('profitloss.update');
            Route::delete('/profitloss/{profitloss}',  'destroy')->name('profitloss.destroy');
        }
    );
});
