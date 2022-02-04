<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostPatchRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function store(PostRequest $request, User $user)
    {
        $post = $user->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post Created Successfully',
            'company' => $post
        ], 201);
    }

    public function show(Post $post, $userid, $id)
    {
        return $post->find($id);
    }

    public function updatestore(PostPatchRequest $request, User $user, $id)
    {
        $post = $user->posts()->where("id", $id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post Updated Sucessfully',
            'Post' => $post
        ], 201);
    }

    public function destroy(PostPatchRequest $request, User $user, $id)
    {
        $user->posts()->find($id)->delete();
        return response()->json("Post Deleted");
    }
}
