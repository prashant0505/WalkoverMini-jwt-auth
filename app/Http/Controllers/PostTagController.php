<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post_tag::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Post::find($request->postId)->user_id;
            $logUser = auth()->user();
            if($logUser->id != $user){
                return response()->json(['error'=>"denied{userId}"]);
            }
            $PT=Post_tag::create([
            'post_id' => $request->post_id,
            'tag_id' => $request->tag_id,
        ]);
            return response()->json([
                'message' => 'Post-Tag Attached Successfully',
                'company' => $PT
            ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post_tag $post_tags,$postId,$tagId)
    {   
        $com = $post_tags->where("post_id",'=', $postId)->get()->Where(["tag_id",'=', $tagId]);
            if($com)
                $com->each->delete();
            else
                return response()->json("tag not used");
        return response()->json("deleted");
    }
}
