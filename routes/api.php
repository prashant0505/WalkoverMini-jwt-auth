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

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('profile', [AuthController::class, 'profile']);
});

Route::group(['middleware' => ['jwt.verify']], function () {

    // Routes for Company
    Route::get('/companies/{id}', [CompanyController::class, 'show']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::patch('/companies/{id}', [CompanyController::class, 'update']);
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

    // Routes for users
    Route::get('/companies/{company}/users/{id}', [UserController::class, 'show']);
    Route::post('/companies/{company}/users', [UserController::class, 'store']);
    Route::patch('/companies/{company}/users/{id}', [UserController::class, 'update']);
    Route::delete('/companies/{company}/users/{id}', [UserController::class, 'destroy']);

    // Routes for Post
    Route::get('/users/{user}/posts/{id}', [PostController::class, 'show']);
    Route::post('/users/{user}/posts', [PostController::class, 'store']);
    Route::patch('/users/{user}/posts/{id}', [PostController::class, 'update']);
    Route::delete('/users/{user}/posts/{id}', [PostController::class, 'destroy']);

    // Routes for Category
    Route::get('/users/{user}/categories', [CategoryController::class, 'index']);
    Route::get('/users/{user}/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/users/{user}/categories', [CategoryController::class, 'store']);
    Route::patch('/users/{user}/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/users/{user}/categories/{id}', [CategoryController::class, 'destroy']);

    // Routes for Tag
    Route::get('/users/{user}/tags', [TagController::class, 'index']);
    Route::get('/users/{user}/tags/{id}', [TagController::class, 'show']);
    Route::post('/users/{user}/tags', [TagController::class, 'create']);
    Route::patch('/users/{user}/tags/{id}', [TagController::class, 'update']);
    Route::delete('/users/{user}/tags/{id}', [TagController::class, 'destroy']);

    // Routes for Comment
    Route::get('/users/{user}/comments', [CommentController::class, 'index']);
    Route::get('/users/{user}/comments/{id}', [CommentController::class, 'show']);
    Route::post('/users/{user}/comments', [CommentController::class, 'create']);
    Route::patch('/users/{user}/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/users/{user}/comments/{id}', [CommentController::class, 'destroy']);

    // Routes for Post-Tag
    Route::get('/posttags/{post_id}', [PostTagController::class, 'index']);
    Route::post('/posttags', [PostTagController::class, 'store']);
    Route::delete('/posttags/{post_id}/{tag_id}', [PostTagController::class, 'destroy']);
});
