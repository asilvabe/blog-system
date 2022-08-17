<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('home', 'home')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class,'create'])->name('posts.create');
    Route::post('posts', [PostController::class,'store'])->name('posts.store');
});
