<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FeedbackController::class, 'home'])->name('home');
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/data', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('/data/{feedback}', [FeedbackController::class, 'show'])->name('feedback.show');
Route::get('/data/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::put('/data/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::delete('/data/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
Route::post('/data/{id}/restore', [FeedbackController::class, 'restore'])->name('feedback.restore');
Route::delete('/data/{id}/force-delete', [FeedbackController::class, 'forceDelete'])->name('feedback.force-delete');
Route::post('/data/{feedback}/notes', [FeedbackController::class, 'storeNote'])->name('feedback.notes.store');