<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Requests\TagPatchRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function create(TagRequest $request, User $user)
    {
        $tag = $user->tags()->create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Tag Created Successfully',
            'user' => $tag
        ], 201);
    }

    public function show(Tag $tag, $user_id, $id)
    {
        return $tag->find($id);
    }

    public function update(TagPatchRequest $request, User $user, $id)
    {
        $tag = $user->tags()->where("id", $id)->update([
            'name' => $request->name,
            'user_id' => $request->userId,
        ]);
        return response()->json([
            'message' => 'Tag Updated Succesfully',
            'user' => $tag
        ], 201);
    }

    public function destroy(TagPatchRequest $request, User $user, $user_id, $id)
    {
        $user->tags()->find($id)->delete();
        return response()->json("Tag Deleted");
    }
}
