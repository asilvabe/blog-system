<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/posts', [PostController::class,'store'] )->name('posts.store');
Route::get('posts/create', [PostController::class,'create'] )->name('posts.create');

