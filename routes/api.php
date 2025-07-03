<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatgeoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/comments',CommentsController::class);

Route::apiResource('/articles',ArticlesController::class);

Route::apiResource('/categories',CatgeoryController::class);



Route::post('/roles', [RoleController::class,'assignrole'])->middleware('role:admin');

Route::post('/roles', [RoleController::class,'removeRole'])->middleware('role:admin');



