<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_user'])->name('login_user');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'create_user'])->name('create_user');
});

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/filter', [HomeController::class, 'filter'])->name('home.filter');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::middleware(['auth'])->group(function () {

    Route::get('/friends', [FriendsController::class, 'index'])->name('friends');
    Route::post('/friends', [FriendsController::class, 'add_friend'])->name('friends.add');
    Route::post('/friends/{id}/accept', [FriendsController::class, 'accept_friend'])->name('friends.accept');
    Route::post('/friends/{id}/reject', [FriendsController::class, 'reject_friend'])->name('friends.reject');
    Route::post('/friends/{id}/remove', [FriendsController::class, 'remove_friend'])->name('friends.remove');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/visibility/toggle', [AuthController::class, 'toggle_visibility'])->name('profile.visibility.toggle')->middleware('auth');

    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'process_payment'])->name('payment.process');
    Route::post('/payment/overpay', [PaymentController::class, 'handle_overpayment'])->name('payment.overpay');

    Route::get('/topup', [PaymentController::class, 'topup_page'])->name('topup');
    Route::post('/topup', [PaymentController::class, 'topup'])->name('coin.add');

    Route::get('/messages', [MessageController::class, 'message'])->name('messages');
    Route::post('/messages', [MessageController::class, 'send'])->name('messages.send');
    Route::get('/messages/{id}', [MessageController::class, 'message_someone'])->name('message.person');

    Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
});
