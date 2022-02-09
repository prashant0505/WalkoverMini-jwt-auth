<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTag\IndexPostTagRequest;
use App\Http\Requests\PostTag\ShowPostTagRequest;
use App\Http\Requests\PostTag\StorePostTagRequest;
use App\Models\Post;
use App\Models\Tag;

class PostTagController extends Controller
{
    public function index(IndexPostTagRequest $request, Post $post){
        return $post->tags;
    }
    
    public function show(ShowPostTagRequest $request, Tag $tag){
        return $tag->posts;
    }

    public function store(StorePostTagRequest $request, Post $post){
        $posttag = $post->tags()->sync([$request->tag_id]);
            return response()->json([
                'message' => 'Tag used in Post Successfully ',
                'PostTag' => $posttag
            ], 201);
    }
 }
