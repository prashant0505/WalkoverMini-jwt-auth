<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Http\Requests\Comment\ShowCommentRequest;
use App\Http\Requests\Comment\IndexCommentRequest;

class CommentController extends Controller
{
    
    public function index(IndexCommentRequest $request, User $user)
    {
        return $user->comments()->get();
    }
    
    public function show(ShowCommentRequest $request, User $user, Comment $comment)
    {
        return $comment;
    }

    public function store(StoreCommentRequest $request, User $user)
    {
        $comment = $user->comments()->create($request->validated);
        return response()->json([
            'message' => 'Comment made Successfully',
            'company' => $comment
        ], 201);
    }

    public function update(UpdateCommentRequest $request, User $user, Comment $comment)
    {
        $updated = $comment->update($request->validated);
        return response()->json([
            'message' => 'Comment Updated Successfully',
            'Comment' => $updated
        ], 201);
    }

    public function destroy(DeleteCommentRequest $request, User $user, Comment $comment)
    {
        if ($comment->delete())
            return response()->json("Comment Deleted Successfully");
    }
}
