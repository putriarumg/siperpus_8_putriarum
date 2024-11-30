<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/books', [BookController::class, 'index'])->name('book');
});

Route::group(['middleware' => ['role:pustakawan']], function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/books/store', [BookController::class, 'store'])->name('book.store');
    Route::match(['put','patch'],'/books/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/books/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/books/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/books/import', [BookController::class, 'import'])->name('book.import');
});

require __DIR__.'/auth.php';
