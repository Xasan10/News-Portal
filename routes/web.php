<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeViewController;
use App\Http\Controllers\MediaViewController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeViewController::class,'index'])->name('home');

Route::get('/category/ajax/{slug}', [HomeViewController::class, 'ajaxFilteredArticles']);


Route::get('/category/ajax/{slug}', [CategoryViewController::class, 'ajaxFilteredArticles']);

Route::get('/category',[CategoryViewController::class,'index'])->name('category');

Route::get('/media',[MediaViewController::class,'index'])->name('media');


route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');

route::get('/dashboard',[DashboardController::class,'showDashboard'])->name('showDashboard')->middleware(['auth','role:admin']);


Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});