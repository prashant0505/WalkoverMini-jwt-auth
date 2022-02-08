<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\DeleteTagRequest;
use App\Http\Requests\Tag\IndexTagRequest;
use App\Http\Requests\Tag\ShowTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\User;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(IndexTagRequest $request, User $user)
    {
        return $user->tags()->get();
    }

    public function show(ShowTagRequest $request, User $user, Tag $tag)
    {
        return $tag;
    }

    public function create(StoreTagRequest $request, User $user)
    {
        $tag = $user->tags()->create($request->validated);

        return response()->json([
            'message' => 'Tag Created Successfully',
            'user' => $tag
        ], 201);
    }

    public function update(UpdateTagRequest $request, User $user, Tag $tag)
    {
        $tag = $tag->update($request->validated);
        return response()->json([
            'message' => 'Tag Updated Succesfully',
            'user' => $tag
        ], 201);
    }

    public function destroy(DeleteTagRequest $request, User $user, Tag $tag)
    {
        if($tag->delete())
        return response()->json("Tag Deleted Successfully");
    }
}
