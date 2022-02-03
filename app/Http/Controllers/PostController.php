<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostPatchRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(PostRequest $request, User $user)
    {

        $p = $user->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            // 'user_id'=>$request->user_id,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post successfully created',
            'company' => $p
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post, $userid, $id)
    {
        return $Post->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $Post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function updatestore(PostPatchRequest $request, User $user, $id)
    {

        $p = $user->posts()->where("id", $id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'message' => 'Post successfully updated',
            'Post' => $p
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostPatchRequest $request, User $user, $id)
    {
        $cat = $user->posts()->delete($id);

        return response()->json("deleted");
    }
}
