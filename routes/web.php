<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/menu', function () {
    return view('menu');
})->name('menu.index');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return app(\App\Http\Controllers\User\DashboardController::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');

// User Panel Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    // Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});

require __DIR__ . '/auth.php';

// Google Auth
Route::get('auth/google', [App\Http\Controllers\Auth\SocialiteController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callback'])->name('auth.google.callback');
