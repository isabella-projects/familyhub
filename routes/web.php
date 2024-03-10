<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::get('/manage-avatar', [UserController::class, 'showAvatarForm']);

Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustBeLoggedIn');

// Blog related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');

Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');

Route::put('/post/{post}', [PostController::class, 'updatePost'])->middleware('can:update,post');

Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post');

// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile'])->middleware('mustBeLoggedIn');

// Admin route (Gate)
Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->middleware('can:visitAdminPage');
