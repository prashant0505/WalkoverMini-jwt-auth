<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostTagController extends Controller
{
    public function index(Post_tag $post_tags)
    {
        return $post_tags->all();
    }

    public function create(Request $request, Post $post)
    {
        $user = $post->find($request->postId)->user_id;
        $logUser = auth()->user();
        if ($logUser->id != $user) {
            return response()->json(['error' => "denied{userId}"]);
        }
        $PT = $post->create([
            'post_id' => $request->post_id,
            'tag_id' => $request->tag_id,
        ]);
        return response()->json([
            'message' => 'Post-Tag Attached Successfully',
            'company' => $PT
        ], 201);
    }

    public function destroy(Post_tag $post_tags, $postId, $tagId)
    {
        $com = $post_tags->where("post_id", '=', $postId)->get()->Where(["tag_id", '=', $tagId]);
        if ($com)
            $com->each->delete();
        else
            return response()->json("tag not used");
        return response()->json("deleted");
    }
}
