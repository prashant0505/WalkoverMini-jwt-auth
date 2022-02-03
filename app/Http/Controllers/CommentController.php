<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentPatchRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(CommentRequest $request, User $user)
    {
        $comment = $user->comments()->create([
            'body' => $request->body,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'message' => 'Commented Successfully ',
            'user' => $comment
        ], 201);
    }

    public function show(Comment $comment, $userid, $id)
    {
        return $comment->find($id);
    }

    public function update(CommentPatchRequest $request, User $user, $id)
    {
        $comment = $user->comments()->where("id", $id)->update([
            'body' => $request->body,
            'user_id' => $request->userId,
            'post_id' => $request->postId
        ]);
        return response()->json([
            'message' => 'Comment Edited Successfully',
            'user' => $comment
        ], 201);
    }

    public function destroy(CommentPatchRequest $request, User $user, $id)
    {
        $user->comments()->delete($id);
        return response()->json("Comment Deleted");
    }
}
