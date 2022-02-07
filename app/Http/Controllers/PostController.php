<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\ShowPostRequest;
use App\Http\Requests\Post\IndexPostRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request, User $user)
    {
        return $user->posts()->get();
    }
    
    public function show(ShowPostRequest $request, User $user, Post $post)
    {
        return $post;
    }

    public function store(StorePostRequest $request, User $user)
    {
        $post = $user->posts()->create(array_filter($request->all()));
        return response()->json([
            'message' => 'Post successfully created', 
            'Post' => $post], 201);
    }

    public function update(UpdatePostRequest $request, User $user, Post $post)
    {
        $updated = $post->update(array_filter($request->all()));
        return response()->json([
            'message' => 'Post successfully updated', 
            'Post' => $updated], 201);
    }

    public function destroy(DeletePostRequest $request, User $user, Post $post)
    {
        if ($post->delete())
            return response()->json("Post Deleted Successfully");
    }
}
