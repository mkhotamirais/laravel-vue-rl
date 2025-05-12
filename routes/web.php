<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');
Route::inertia('/about', 'About')->name('about');

Route::resource('blog', BlogController::class);
Route::resource('sewa-mobil', RentalController::class);

Route::post('/set-locale', function (Request $request) {
    $locale = $request->locale;
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
});

require __DIR__ . '/auth.php';
