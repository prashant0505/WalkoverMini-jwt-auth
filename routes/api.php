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

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('profile', [AuthController::class,'profile']);

});

// Routes for Company 
Route::get('/companies/{id}',[CompanyController::class,'show']);
Route::post('/companies',[CompanyController::class,'store']);
Route::put('/companies/{id}',[CompanyController::class,'update']);
Route::delete('/companies/{id}',[CompanyController::class,'destroy']);

Route::group(['middleware' => ['jwt.verify']], function() {

// Routes for Users
Route::get('/companies/{companyId}/user/{id}',[Usercontrollerontroller::class,'show']);
Route::post('/companies/{companyId}/user', [UserController::class,'create']);
Route::put('/companies/{companyId}/user/{id}',[UserController::class,'update']);
Route::delete('/companies/{companyId}/user/{id}',[Usercontrollerontroller::class,'destroy']);

// Routes for Post
Route::get('/users/posts',[PostController::class,'index']);
Route::get('/users/posts/{id}',[PostController::class,'show']);
Route::post('/users/{user_id}/posts',[PostController::class,'store']);
Route::put('/users/{user_id}/posts/{id}',[PostController::class,'update']);
Route::delete('/users/posts/{id}',[PostController::class,'destroy']);

// Routes for Category
Route::get('/users/{user_id}/categories',[CategoryController::class,'index']);
Route::get('/users/{user_id}/categories/{id}',[CategoryController::class,'show']);
Route::post('/users/{user_id}/categories',[CategoryController::class,'store']);
Route::put('/users/{user_id}/categories/{id}',[CategoryController::class,'update']);
Route::delete('/users/{users_id}/categories/{id}',[CategoryController::class,'destroy']);

// Routes for Tag
Route::get('/users/{user_id}/tags',[TagController::class,'index']);
Route::get('/users/{user_id}/tags/{id}',[TagController::class,'show']);
Route::post('/users/{user_id}/tags',[TagController::class,'store']);
Route::put('/users/{user_id}/tags/{id}',[TagController::class,'update']);
Route::delete('/users/{user_id}/tags/{id}',[TagController::class,'destroy']);

// Routes for Comment
Route::get('/users/{user_id}/comments',[CommentController::class,'index']);
Route::get('/users/{user_id}/comments/{id}',[CommentController::class,'show']);
Route::post('/users/{user_id}/comments',[CommentController::class,'store']);
Route::put('/users/{user_id}/comments/{id}',[CommentController::class,'update']);
Route::delete('/users/{user_id}/comments/{id}',[CommentController::class,'destroy']);

// Routed for PostTag 
Route::get('/posts/{post_id}/tags',[PostTagController::class,'index']);
Route::post('/posttags',[PostTagController::class,'create']);
Route::post('/posts/{post_id}/tags/{tag_id}',[PostTagController::class,'destroy']);

});