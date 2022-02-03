<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentPatchRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        $logUser = auth()->user();
        if ($logUser->id != $request->user_id) {
            return response()->json(['error' => "denied{userId}"]);
        }
        $comm = $comment->create([
            'Body' => $request->body,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);
        return response()->json([
            'message' => 'Commented successfully ',
            'user' => $comm
        ], 201);
    }

    public function show($user_id, $id, Comment $comment)
    {
        return $comment->find($id);
    }

    public function update(CommentPatchRequest $request, Comment $comment, $user_id, $id)
    {
        $comm = $comment->find($id);
        $logUser = auth()->user();
        if ($logUser->id != $comm->user_id) {
            return response()->json(['error' => "cannot update comment of diff user"]);
        }
        $commented = $comm->where("id", $id)->update([
            'body' => $request->body,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);
        return response()->json([
            'message' => 'Comment Updated successfully ',
            'Comment' => $commented
        ], 201);
    }

    public function destroy(Comment $comments, $id)
    {
        $com = $comments->find($id);
        if ($com)
            $com->delete();
        else
            return response()->json("comment dosn't exist");
        return response()->json("deleted");
    }
}
