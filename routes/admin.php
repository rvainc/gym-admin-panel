<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Middleware\HandleInertiaRequests;
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

Route::middleware([])->name('admin.')->group(function () {
    // Home controller
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Customer controller
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::post('/customers/{customer}/restore', [CustomerController::class, 'restore'])->withTrashed()->name('customers.restore');
    Route::patch('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.delete');

    // Subscription controller
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::patch('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscriptions.update');
    Route::post('/subscriptions/{subscription}/restore', [SubscriptionController::class, 'restore'])->withTrashed()->name('subscriptions.restore');    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscriptions.delete');

});
