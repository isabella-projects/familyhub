<?php

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowController;

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
Route::get('/manage-avatar', [UserController::class, 'showAvatarForm'])->middleware('mustBeLoggedIn');

Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustBeLoggedIn');

// Follow related routes
Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('mustBeLoggedIn');
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('mustBeLoggedIn');

// Blog related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');
Route::get('/search/{term}', [PostController::class, 'search'])->middleware('mustBeLoggedIn');

Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');

Route::put('/post/{post}', [PostController::class, 'updatePost'])->middleware('can:update,post');

Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post');

// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile'])->middleware('mustBeLoggedIn');
Route::get('/profile/{user:username}/followers', [UserController::class, 'profileFollowers'])->middleware('mustBeLoggedIn');
Route::get('/profile/{user:username}/following', [UserController::class, 'profileFollowing'])->middleware('mustBeLoggedIn');

// Enhancement with client-side javascript
Route::middleware('cache.headers:public;max_age=20;etag')->group(function () {
    Route::get('/profile/{user:username}/raw', [UserController::class, 'profileRaw']);
    Route::get('/profile/{user:username}/followers/raw', [UserController::class, 'profileFollowersRaw']);
    Route::get('/profile/{user:username}/following/raw', [UserController::class, 'profileFollowingRaw']);
});

// Admin route (Gate)
Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->middleware('can:visitAdminPage');

// Chat route
Route::post('/send-chat-message', function (Request $request) {

    $formFields = $request->validate([
        'textvalue' => 'required'
    ]);

    if (!trim(strip_tags($formFields['textvalue']))) {
        return response()->noContent();
    }

    broadcast(new ChatMessage([
        'username' => auth()->user()->username,
        'textvalue' => strip_tags($request->textvalue),
        'avatar' => auth()->user()->avatar
    ]))->toOthers();

    return response()->noContent();
})->middleware('mustBeLoggedIn');
