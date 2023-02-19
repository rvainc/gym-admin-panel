<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
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

Route::middleware(['auth', 'verified'])->name('admin.')->group(function () {
    // Home controller
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    // Customer controller
    Route::resource('customers', CustomerController::class);
    Route::post('/customers/{customer}/restore', [CustomerController::class, 'restore'])
        ->withTrashed()
        ->name('customers.restore');

    // Subscription controller
    Route::resource('subscriptions', SubscriptionController::class);
    Route::post('/subscriptions/{subscription}/restore', [SubscriptionController::class, 'restore'])
        ->withTrashed()
        ->name('subscriptions.restore');

    // Transaction controller
    Route::resource('transactions', TransactionController::class, [
        'only' => ['index', 'create', 'show', 'store'],
    ]);

    // User controller
    Route::resource('users', UserController::class);
});
