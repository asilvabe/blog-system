<?php

use App\Http\Controllers\ApprovePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}/approve', ApprovePostController::class)->name('posts.approver');
});

Route::get('posts/{post}', [PostController::class,'show'] )->name('posts.show');
