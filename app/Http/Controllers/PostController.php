<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPatchRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return $post->all();
    }

    public function store(PostRequest $request, Post $post, $userId)
    {
        $logUser = auth()->user();
        if ($logUser->id != $request->user_id) {
            return response()->json(['error' => "denied{userId}"]);
        }
        $p = $post->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post successfully created',
            'company' => $p
        ], 201);
    }

    public function show($user_id, $id)
    {
        return Post::find($id);
    }

    public function update(PostPatchRequest $request, Post $post, $userId, $id)
    {
        $p = $post->find($id);
        $logUser = auth()->user();
        if ($logUser->id != $p->user_id) {
            return response()->json(['error' => "cannot update to another users post"]);
        }
        $posted = $p->where("id", $id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post successfully created',
            'company' => $posted
        ], 201);
    }

    public function destroy(Post $post, $id)
    {
        $post = $post->find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'message' => 'Post destroyed successfully',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Post does not exists',
            ], 404);
        }
    }
}
