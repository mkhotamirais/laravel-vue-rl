<?php

use App\Http\Controllers\BlogcatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::resource('blog', BlogController::class);
Route::resource('sewa-mobil', RentalController::class)->parameters(['sewa-mobil' => 'rental']);

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->middleware('verified')->name('dashboard');
    Route::resource('blogcat', BlogcatController::class);
});

Route::post('/set-locale', function (Request $request) {
    $locale = $request->locale;
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
});

require __DIR__ . '/auth.php';
