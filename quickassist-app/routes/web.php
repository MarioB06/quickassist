<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketCategoryController;

// Startseite
Route::get('/', function () {
    return view('welcome');
});

Route::post('/tickets', [TicketController::class, 'store'])
    ->name('tickets.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TicketController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tickets', TicketController::class)->except(['store']);

    Route::get('/ticket-categories', [TicketCategoryController::class, 'index'])->name('ticket-categories.index');
    Route::post('/ticket-categories', [TicketCategoryController::class, 'store'])->name('ticket-categories.store');

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');

    Route::post('/tickets/{ticket}/comments', [TicketCommentController::class, 'store'])->name('ticket-comments.store');
    Route::post('/tickets/{ticket}/comments', [TicketCommentController::class, 'store'])
        ->middleware('auth')
        ->name('ticket-comments.store');

});

require __DIR__ . '/auth.php';
