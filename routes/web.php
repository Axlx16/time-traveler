<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\ReactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/predictions', [PredictionController::class, 'index'])->name('predictions.index');
Route::get('/predictions/create', [PredictionController::class, 'create'])->name('predictions.create');
Route::post('/predictions/submit', [PredictionController::class, 'submit'])->name('predictions.submit');

Route::get('/prediction/{id}', [PredictionController::class, 'show'])->name('predictions.show');

Route::get('/reactions', [ReactionController::class, 'get'])->name('reactions.get');
Route::post('/reactions/update', [ReactionController::class, 'update'])->name('reactions.update');

Route::get('/user/{id}', [ProfileController::class, 'user'])->name('profile.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
