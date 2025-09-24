<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('company-profile')->group(function () {
    Route::get('/layanan', function () {
        return view('compro.layanan');
    })->name('compro.layanan');

    Route::get('/tentang', function () {
        return view('compro.tentang');
    })->name('compro.tentang');

    Route::get('/berita', function () {
        return view('compro.berita');
    })->name('compro.berita');

    Route::get('/kontak', function () {
        return view('compro.kontak');
    })->name('compro.kontak');
});
