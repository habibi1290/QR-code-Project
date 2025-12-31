<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/anmelden', function () {
   return view('anmelden');
})->name('anmelden');

Route::get('/test', function () {
    return view('auth/paypal');
});


Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
Route::post('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paypalPaymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paypalPaymentCancel'])->name('paypal.payment.cancel');
