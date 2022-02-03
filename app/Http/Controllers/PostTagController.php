<?php

namespace App\Http\Controllers;

use App\Models\Post_Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostTagRequest;

class PostTagController extends Controller
{
    public function index(Post_Tag $Post_Tag, $post_id)
    {
        return Post_Tag::where('post_id', $post_id)->get();
    }

    public function store(Request $request, Post_Tag $Post_Tag, posttagRequest $posttagRequest)
    {
        $user = $Post_Tag->find($request->postId)->user_id;
        $logUser = auth()->user();

        if ($logUser->id != $user) {
            return response()->json(['error' => "denied{userId}"]);
        }

        $tag = Post_Tag::create([
            'post_id' => $request->postId,
            'tag_id' => $request->tagId,
        ]);
        return response()->json([
            'message' => 'tag inserted in post successfully ',
            'company' => $tag
        ], 201);
    }

    public function update(Request $request, Post_Tag $Post_Tag)
    {
    }

    public function destroy(Post_Tag $Post_Tag, $postId, $tagId)
    {
        $com = $Post_Tag->where("post_id", '=', $postId)->get()->Where(["tag_id", '=', $tagId]);

        if ($com)
            $com->each->delete();
        else
            return response()->json("tag not used");
        return response()->json("deleted");
    }
}
