<?php

use App\Http\Controllers\CryptoPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CryptoPageController::class, 'home'])->name('home');

Route::get('/hash', [CryptoPageController::class, 'hash'])->name('hash');
Route::post('/hash', [CryptoPageController::class, 'processHash'])->name('hash.process');

Route::get('/rsa', [CryptoPageController::class, 'rsa'])->name('rsa');
Route::post('/rsa', [CryptoPageController::class, 'processRsa'])->name('rsa.process');

Route::get('/des', [CryptoPageController::class, 'des'])->name('des');
Route::post('/des', [CryptoPageController::class, 'processDes'])->name('des.process');

Route::get('/gost', [CryptoPageController::class, 'gost'])->name('gost');
Route::post('/gost', [CryptoPageController::class, 'processGost'])->name('gost.process');

Route::get('/tentang', [CryptoPageController::class, 'about'])->name('about');
