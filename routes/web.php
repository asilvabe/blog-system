<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class,'create'])->name('posts.create');
    Route::post('posts', [PostController::class,'store'])->name('posts.store');
});

Route::get('/', [PostController::class,'index'])->name('posts.index');
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
