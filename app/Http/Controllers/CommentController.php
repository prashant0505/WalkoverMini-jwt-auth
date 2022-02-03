<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
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
    public function store(CommentRequest $request)
    {      
        $logUser = auth()->user();
        if($logUser->id != $request->user_id){
            return response()->json(['error'=>"denied{userId}"]);
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
    public function show($user_id,$id)
    {
        return Comment::find($id);
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
    public function update(CommentRequest $request, Comment $comment, $user_id, $id)
    {
        $comm=$comment->find($id);
        $logUser = auth()->user();
        if($logUser->id != $comm->user_id){
            return response()->json(['error'=>"cannot update comment of diff user"]);
        }
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
