<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post,$userId)
    {
        $logUser = auth()->user();
        if($logUser->id != $request->user_id){
            return response()->json(['error'=>"denied{userId}"]);
        }
            $p=$post->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id'=>$request->user_id,
            'category_id'=>$request->category_id,
        ]);
            return response()->json([
                'message' => 'Post successfully created',
                'company' => $p
            ], 201);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$id)
    {
        return Post::find($id);
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
    public function update(PostRequest $request, Post $post,$userId,$id)
    {
        $p=$post->find($id);
        $logUser = auth()->user();
            if($logUser->id != $p->user_id){
            return response()->json(['error'=>"cannot update to another users post"]);
        }
        $posted=$p->where("id",$id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id'=>$request->user_id,
            'category_id'=>$request->category_id,
        ]);
            return response()->json([
                'message' => 'Post successfully created',
                'company' => $posted
            ], 201);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json([
            'message' => 'Post destroyed successfully',
            ], 201);
        }
        else {
            return response()->json([
                'message' => 'Post does not exists',
                ], 404);
        }
    }
}
