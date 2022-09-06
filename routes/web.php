<?php

use App\Http\Controllers\ApprovePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'main'])->name('posts.welcome');

Route::middleware(['auth'])->prefix('posts')->name('posts.')->group(function () {
    Route::get('create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::patch('{post}/approve', ApprovePostController::class)->name('approve');
    Route::get('/', [PostController::class, 'index'])->name('index');
});

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
