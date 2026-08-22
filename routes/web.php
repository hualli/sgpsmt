<?php

use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('permits', [PermitController::class, 'index'])
        ->name('permits.index')
        ->middleware('can:manage-permits');
    Route::get('permits/{permit}', [PermitController::class, 'show'])
        ->name('permits.show')
        ->middleware('can:manage-permits');
    Route::patch('permits/{permit}/status', [PermitController::class, 'updateStatus'])
        ->name('permits.status')
        ->middleware('can:manage-permits');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('zones', ZoneController::class)
        ->except(['show'])
        ->middleware('can:manage-system');

    Route::resource('rates', RateController::class)
        ->except(['show'])
        ->middleware('can:manage-system');
});

require __DIR__.'/auth.php';
