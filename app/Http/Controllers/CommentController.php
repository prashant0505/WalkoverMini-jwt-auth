<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:100',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
       
        $comm = Comment::create([
            'Body' => $request->body,
            'user_id' => $request->user_id,
            'post_id'=>$request->post_id            
            ]);
        return response()->json([
            'message' => 'Commented successfully ',
            'user' => $comm
        ], 201);
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
    public function update(Request $request, Comment $comment, $user_id, $id)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:100',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $comm=$comment->find($id);
        $commented=$comm->where("id",$id)->update([
            'body' => $request->body,
            'user_id' => $request->user_id,
            'post_id'=>$request->post_id            
            ]);
        return response()->json([
            'message' => 'Comment Updated successfully ',
            'Comment' => $commented
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comments,$id)
    {
        $com = $comments->find($id);
        if($com)
           $com->delete();
        else
            return response()->json("comment dosn't exist");
        return response()->json("deleted");
    }
}
