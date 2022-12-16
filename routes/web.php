<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/halamanbaru', function () {
    return view('halamanbaru');
})->middleware(['auth', 'verified'])->name('halamanbaru');

Route::group(['middleware' => 'auth'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user');
        Route::get('/userRegistration', 'create')->name('userRegistration');
        Route::post('/userStore', 'store')->name('userStore');
        Route::get('/userView/{user}', 'show')->name('userView');
        Route::post('/userUpdate/{id}', 'update')->name('userUpdate');
    });

    Route::controller(CollectionController::class)->group(function () {
        Route::get('/koleksi', 'index')->name('koleksi');
        Route::get('/koleksiTambah', 'create')->name('koleksiTambah');
        Route::post('/koleksiStore', 'store')->name('koleksiStore');
        Route::get('/koleksiView/{collection}', 'show')->name('koleksiView');
        Route::post('/koleksiUpdate/{id}', 'update')->name('koleksiUpdate');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaksi');
        Route::get('/transaksiTambah', 'create')->name('transaksiTambah');
        Route::post('/transaksiStore', 'store')->name('transaksiStore');
        Route::get('/transaksiView/{transaction}', 'show')->name('transaksiView');
        Route::get('/getAllTransactions', 'getAllTransactions')->name('getAllTransaction');
    });

    Route::controller(DetailTransactionController::class)->group(function () {
        Route::get('/detailTransactionKembalikan/{id}', 'detailTransactionKembalikan')->name('kembalikan');
        Route::post('/detailTransactionUpdate/{id}', 'update')->name('updateDetailTransaksi');
        Route::get('/getAllDetailTransactions/{id}', 'getAllDetailTransactions')->name('getAllDetailTransactions');
    });
});

require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
