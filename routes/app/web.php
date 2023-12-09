<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\CouponController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\RegionalController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\InformationController;
use App\Http\Controllers\Web\NotificationController;

Route::group(['domain' => ''], function () {
    Route::get('', [AuthController::class, 'index'])->name('auth');
    Route::post('auth/login', [AuthController::class, 'do_login'])->name('login');
    Route::post('auth/register', [AuthController::class, 'do_register'])->name('register');

    Route::prefix('')->name('web.')->group(function () {
        Route::middleware('Customer')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('dashboard/{ticket}', [DashboardController::class, 'show'])->name('dashboard.show');

            // CART
            Route::get('counter_cart', [CartController::class, 'notif'])->name('counter_cart');
            Route::get('cart', [CartController::class, 'index'])->name('cart.index');
            Route::post('cart/add', [CartController::class, 'store'])->name('cart.add');
            Route::patch('cart/increase/{cart}', [CartController::class, 'increase'])->name('cart.increase');
            Route::patch('cart/decrease/{cart}', [CartController::class, 'decrease'])->name('cart.decrease');
            Route::patch('cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
            Route::delete('cart/delete/{cart}', [CartController::class, 'destroy'])->name('cart.delete');

            // Checkout
            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
            Route::post('checkout/coupon', [CheckoutController::class, 'check_coupon'])->name('checkout.coupon');
            Route::post('check', [CheckoutController::class, 'check'])->name('check');
            Route::get('checkout/{order}/pdf', [CheckoutController::class, 'pdf'])->name('checkout.pdf');
            Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
            Route::get('checkout/{id}', [CheckoutController::class, 'checkout_detail'])->name('checkout.detail');

            // NOTIFICATION
            Route::get('counter', [NotificationController::class, 'counter'])->name('counter_notif');
            Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');

            // ORDER
            Route::get('order', [OrderController::class, 'index'])->name('order.index');
            Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
            Route::get('order/{order}/pdf', [OrderController::class, 'pdf'])->name('order.pdf');

            // INFORMATION
            Route::get('informations', [InformationController::class, 'index'])->name('informations.index');
            Route::get('informations/{information}', [InformationController::class, 'show'])->name('informations.show');

            // REVIEW
            Route::get('reviews', [CommentController::class, 'index'])->name('reviews');
            Route::post('reviews', [CommentController::class, 'store'])->name('reviews.store');

            Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
        });
    });
});
