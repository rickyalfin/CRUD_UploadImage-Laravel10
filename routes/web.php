<?php

use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\HewanController;
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

Route::get('/', fn() => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/datacustomer/data', [DataCustomerController::class, 'data'])->name('datacustomer.data');
    Route::resource('/datacustomer', DataCustomerController::class);

    Route::get('/hewan/data', [HewanController::class, 'data'])->name('hewan.data');
    Route::resource('/hewan', HewanController::class);

});
