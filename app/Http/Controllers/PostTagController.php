<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTagDeleteRequest;
use App\Models\Post_Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostTagRequest;
use App\Models\Post;

class PostTagController extends Controller
{
    public function index(Post_Tag $Post_Tag, $post_id)
    {
        return Post_Tag::where('post_id', $post_id)->get();
    }

    public function store(PostTagRequest $request, Post $post)
    {
        $posttag = $post->tags()->create([
            'tag_id' => $request->tagId,
            ]);
            return response()->json([
                'message' => 'tag inserted in post successfully ',
                'company' => $posttag
            ], 201);
    }

    public function destroy(PostTagDeleteRequest $request, Post $post, $tagId)
    {
        $com = $post->tags()->Where(["tag_id",'=', $tagId])->get();
        if($com)
           $com->each->delete();
        else
            return response()->json("tag not used");
        return response()->json("deleted");
    }
}
