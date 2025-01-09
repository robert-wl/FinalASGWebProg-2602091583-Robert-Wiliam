<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/filter', [HomeController::class, 'filter'])->name('home.filter');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/wishlist', [FriendsController::class, 'index'])->name('wishlist.add');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'create_user'])->name('create_user');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_user'])->name('login_user');

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment', [PaymentController::class, 'process_payment'])->name('payment.process');
Route::post('/payment/overpay', [PaymentController::class, 'handle_overpayment'])->name('payment.overpay');
