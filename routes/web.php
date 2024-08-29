<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('users', UserController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);

Route::get('users/{id}/posts', [UserController::class, 'getPosts']);
Route::get('users/{id}/comments', [UserController::class, 'getComments']);
Route::get('posts/{id}/comments', [PostController::class, 'getComments']);