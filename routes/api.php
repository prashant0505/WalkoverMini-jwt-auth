<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostTagController;

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

    // Route for Company
    Route::resource('companies', 'CompanyController');

    // Routes for user
    Route::resource('/companies/{company}/users', 'UserController');

    // Routes for Post
    Route::resource('/users/{user}/posts', 'PostController');

    // Routes for Category
    Route::resource('/users/{user}/categories', 'CategoryController');

    // Routes for Tag
    Route::resource('/users/{user}/tags', 'TagController');

    // Routes for Comment
    Route::resource('/users/{user}/comments', 'CommentController');

    // Routes for Post-Tag
    Route::resource('/posts/{post}/tags', 'PostTagController');

    Route::get('/tags/{tag}/posts', [PostTagController::class, 'show']);
});
