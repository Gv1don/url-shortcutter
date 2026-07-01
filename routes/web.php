<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::redirect('/dashboard', '/links')->name('dashboard');
    Route::get('/links', [ShortLinkController::class, 'index'])->name('links.index');
    Route::post('/links', [ShortLinkController::class, 'store'])->name('links.store');
    Route::get('/links/{link}', [ShortLinkController::class, 'show'])->name('links.show');
    Route::delete('/links/{link}', [ShortLinkController::class, 'destroy'])->name('links.destroy');
});

Route::get('/{shortCode}', RedirectController::class)->where('shortCode', '[a-zA-Z0-9]{6,10}');
