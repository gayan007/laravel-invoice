<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice');


    Route::resource('invoices', 'App\Http\Controllers\InvoiceController');

    Route::resource('customers', 'App\Http\Controllers\CustomerController');


});

