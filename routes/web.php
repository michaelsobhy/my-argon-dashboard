<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users/{target_user}/publish', [UserController::class, 'publish'])->name('users.publish');
    Route::post('users/{target_user}/unpublish', [UserController::class, 'unpublish'])->name('users.unpublish');
    Route::post('users/{target_user}/delete', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('posts', [PostController::class, 'index'])->name('posts');
    Route::post('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
    Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
    Route::post('posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.delete');
    Route::get('comments', [CommentController::class, 'index'])->name('comments');
    Route::post('comments/{comment}/publish', [CommentController::class, 'publish'])->name('comments.publish');
    Route::post('comments/{comment}/unpublish', [CommentController::class, 'unpublish'])->name('comments.unpublish');
    Route::post('comments/{comment}/delete', [CommentController::class, 'destroy'])->name('comments.delete');
    Route::get('likes', [LikeController::class, 'index'])->name('likes');
    Route::post('likes/{like}/publish', [LikeController::class, 'publish'])->name('likes.publish');
    Route::post('likes/{like}/unpublish', [LikeController::class, 'unpublish'])->name('likes.unpublish');
    Route::post('likes/{like}/delete', [LikeController::class, 'destroy'])->name('likes.delete');
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

