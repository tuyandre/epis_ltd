<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/quote', [QuoteController::class, 'store'])->middleware('throttle:5,1')->name('quote.store');

Route::prefix('admin')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'show'])->name('login')->middleware('guest');
    Route::post('login', [Admin\AuthController::class, 'login'])->middleware(['guest', 'throttle:10,1'])->name('admin.login');

    Route::middleware('auth')->name('admin.')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');

        Route::get('quotes', [Admin\QuoteRequestController::class, 'index'])->name('quotes.index');
        Route::get('quotes/{quote}', [Admin\QuoteRequestController::class, 'show'])->name('quotes.show');
        Route::patch('quotes/{quote}', [Admin\QuoteRequestController::class, 'update'])->name('quotes.update');
        Route::delete('quotes/{quote}', [Admin\QuoteRequestController::class, 'destroy'])->name('quotes.destroy');

        Route::resource('services', Admin\ServiceController::class)->except('show');
        Route::resource('team', Admin\TeamMemberController::class)->except('show');
        Route::resource('projects', Admin\ProjectController::class)->except('show');
        Route::resource('clients', Admin\ClientController::class)->except('show');
        Route::resource('gallery', Admin\GalleryPhotoController::class)->except('show');
    });
});
