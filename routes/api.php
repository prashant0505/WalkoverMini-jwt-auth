<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

/*
|__________________________________________________________________________
| API Routes
|__________________________________________________________________________
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('profile', [AuthController::class, 'profile']);
    });

    // Routes for Company
    Route::get('/companies', [CompanyController::class, 'index']);
    Route::get('/companies/{company}', [CompanyController::class, 'show']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::patch('/companies/{company}', [CompanyController::class, 'update']);
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy']);

    // Routes for user
    Route::get('/companies/{company}/users', [UserController::class, 'index']);
    Route::get('/companies/{company}/users/{user}', [UserController::class, 'show']);
    Route::post('/companies/{company}/users', [UserController::class, 'store']);
    Route::patch('/companies/{company}/users/{user}', [UserController::class, 'update']);
    Route::delete('/companies/{company}/users/{user}', [UserController::class, 'destroy']);

    // Routes for Post
    Route::get('/users/{user}/posts', [PostController::class, 'index']);
    Route::get('/users/{user}/posts/{post}', [PostController::class, 'show']);
    Route::post('/users/{user}/posts', [PostController::class, 'store']);
    Route::patch('/users/{user}/posts/{post}', [PostController::class, 'update']);
    Route::delete('/users/{user}/posts/{post}', [PostController::class, 'destroy']);

    // Routes for Category
    Route::get('/users/{user}/categories', [CategoryController::class, 'index']);
    Route::get('/users/{user}/categories/{category}', [CategoryController::class, 'show']);
    Route::post('/users/{user}/categories', [CategoryController::class, 'store']);
    Route::patch('/users/{user}/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/users/{user}/categories/{category}', [CategoryController::class, 'destroy']);

    // Routes for Tag
    Route::get('/users/{user}/tags', [TagController::class, 'index']);
    Route::get('/users/{user}/tags/{tag}', [TagController::class, 'show']);
    Route::post('/users/{user}/tags', [TagController::class, 'create']);
    Route::patch('/users/{user}/tags/{tag}', [TagController::class, 'update']);
    Route::delete('/users/{user}/tags/{tag}', [TagController::class, 'destroy']);

    // Routes for Comment
    Route::get('/users/{user}/comments', [CommentController::class, 'index']);
    Route::get('/users/{user}/comments/{comment}', [CommentController::class, 'show']);
    Route::post('/users/{user}/comments', [CommentController::class, 'store']);
    Route::patch('/users/{user}/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/users/{user}/comments/{comment}', [CommentController::class, 'destroy']);

    // Routes for Post-Tag
    Route::get('/posts/{post}/posttags', [PostTagController::class, 'index']);
    Route::get('/tags/{tag}/posttags', [PostTagController::class, 'show']);
    // Route::post('/posts/{post}/tags/{tag}/posttags', [PostTagController::class, 'update']);
    Route::post('/posts/{post}/posttags', [PostTagController::class, 'store']);
    Route::delete('/posts/{post}/posttags/{tag}', [PostTagController::class, 'destroy']);
});
