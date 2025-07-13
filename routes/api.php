<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatgeoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RoleController;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/comments',CommentsController::class);

Route::apiResource('/articles',ArticlesController::class);

Route::apiResource('/categories',CatgeoryController::class);


Route::post('/users/{user}/role', [RoleController::class, 'updateRole'])->name('updateRole');






