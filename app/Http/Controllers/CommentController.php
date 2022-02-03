<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use JWTAuth;
use Hash;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentPatchRequest;
use App\Models\Comment;

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
    public function create(CommentRequest $request, User $user)
    {

        $comm = $user->comments()->create([
            'body' => $request->body,
            //  'user_id' => $request->userId,
            'post_id' => $request->post_id

        ]);

        return response()->json([
            'message' => 'Commented successfully ',
            'user' => $comm
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $Comment, $userid, $id)
    {
        return $Comment->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $Comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentPatchRequest $request, User $user, $id)
    {
        $comm = $user->comments()->where("id", $id)->update([
            'Body' => $request->body,
            'user_id' => $request->userId,
            'post_id' => $request->postId
        ]);
        return response()->json([
            'message' => 'Succesfully updated',
            'user' => $comm
        ], 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentPatchRequest $request, User $user, $id)
    {
        $cat = $user->comments()->delete($id);
        return response()->json("deleted");
    }
}
