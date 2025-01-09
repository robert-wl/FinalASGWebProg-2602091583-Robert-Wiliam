<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'create_user'])->name('create_user');


Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment', [PaymentController::class, 'process_payment'])->name('payment.process');
Route::post('/payment/overpay', [PaymentController::class, 'handle_overpayment'])->name('payment.overpay');
