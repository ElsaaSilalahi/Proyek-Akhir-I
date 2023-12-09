<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\NotificationController;

Route::group(['domain' => ''], function () {
    Route::get('', [AuthController::class, 'index'])->name('auth');
    Route::post('auth/login', [AuthController::class, 'do_login'])->name('login');
    Route::post('auth/register', [AuthController::class, 'do_register'])->name('register');

    Route::prefix('admin/')->name('admin.')->group(function () {
        Route::middleware('Admin')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // USER
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

            // TICKET
            Route::resource('tickets', TicketController::class);

            // ORDER
            Route::get('order', [OrderController::class, 'index'])->name('order.index');
            Route::post('order/export', [OrderController::class, 'export'])->name('order.export');
            Route::get('order/pdf', [OrderController::class, 'pdf'])->name('order.pdf');
            Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
            Route::patch('order/accept/{order}', [OrderController::class, 'accept'])->name('order.accept');
            Route::patch('order/reject/{order}', [OrderController::class, 'reject'])->name('order.reject');
            Route::patch('order/acceptAll', [OrderController::class, 'acceptAll'])->name('order.acceptAll');
            Route::patch('order/rejectAll', [OrderController::class, 'rejectAll'])->name('order.rejectAll');

            // INFORMATION
            Route::resource('informations', InformationController::class);
            Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');

            // REVIEWS
            Route::get('reviews', [CommentController::class, 'index'])->name('reviews');

            // Notification
            Route::get('counter', [NotificationController::class, 'counter'])->name('counter_notif');
            Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
        });
    });
});
