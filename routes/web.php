<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowUserController;


Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('users/', ShowUserController::class)->name('users.index');
});

Route::get('posts/{post}', [PostController::class,'show'] )->name('posts.show');

Route::get('about/', [SettingController::class,'show'] )->name('about.show');
