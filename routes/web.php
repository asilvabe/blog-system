<?php

use App\Http\Controllers\ApprovePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth'])->prefix('posts')->name('posts.')->group(function () {
    Route::get('create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::patch('{post}/approve', ApprovePostController::class)->name('approve');
});

Route::get('posts/{post}', [PostController::class,'show'] )->name('posts.show');
