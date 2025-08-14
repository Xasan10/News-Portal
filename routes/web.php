<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\CatgeoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CommentsViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailsViewController;
use App\Http\Controllers\HomeViewController;
use App\Http\Controllers\LoadMoreController;
use App\Http\Controllers\MediaViewController;
use App\Http\Controllers\PostViewController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', [HomeViewController::class,'index'])->name('home');

Route::get('/category/ajax/{slug}', [HomeViewController::class, 'ajaxFilteredArticles'])->name('category.ajax');


Route::get('category/ajax/{slug}', [CategoryViewController::class, 'filteredArticles'])->name('filter');

Route::get('/category',[CategoryViewController::class,'index'])->name('category');

Route::get('/media',[MediaViewController::class,'index'])->name('media');


route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');

route::get('/dashboard',[DashboardController::class,'showDashboard'])->name('showDashboard')->middleware(['auth', 'role:admin|editor|author']);

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/details/{id}',[DetailsViewController::class,'view'])->name('show.details');

Route::post('/details/comments/{id}', [CommentsViewController::class, 'store'])->name('comments.store');


Route::get('/search',[HomeViewController::class,'search'])->name('search.article');

Route::get('/Profile/{id}',[ProfileViewController::class,'showProfile'])->name('profile');

Route::get('/create-post',[PostViewController::class,'viewCreateArticles'])->name('post');

Route::post('/create-post',[PostViewController::class,'store'])->name('post.store');

Route::post('/update/{id}',[UsersController::class,'update'])->name('users.update');


Route::get('/load-more-articles', [ProfileViewController::class, 'loadMore']);

Route::get('/api/users', [UsersController::class,'searchUser'])->name('search.users');



Route::get('/users',[UsersController::class,'showUsers'])->name('showUsers');


Route::post('/users/{id}/block', [UsersController::class, 'toggleBlock'])->name('users.toggleBlock');

Route::DELETE('/post/{id}', [PostViewController::class, 'destroy'])->name('post.destroy');

Route::get('/post/update-view/{id}',[PostViewController::class,'updateView'])->name('post.updateview');
Route::put('/post/update-view/{id}',[PostViewController::class,'Update'])->name('post.update');

Route::get('/dashboard/categories',[CatgeoryController::class,'showCategory'])->name('category.view');

Route::get('/dashboard/categories/{id}',[CatgeoryController::class,'showEdit'])->name('edit.category');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileViewController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/upload-picture', [ProfileViewController::class, 'uploadPicture'])->name('profile.upload.picture');
});
