<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('home', 'home');

Route::post('/posts', [PostController::class,'store'] )->name('posts.store');
Route::get('posts/create', [PostController::class,'create'] )
    ->middleware('auth')
    ->name('posts.create');
