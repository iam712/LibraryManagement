<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Book Routes
Route::resource('books', BookController::class);
Route::put('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
Route::put('/books/{book}/return', [BookController::class, 'return'])->name('books.return');

// Category Routes
Route::resource('categories', CategoryController::class);

// Member Routes
Route::resource('members', MemberController::class);
Route::get('/members/{member}/books', [MemberController::class, 'books'])->name('members.books');
