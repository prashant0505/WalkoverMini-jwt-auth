<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagPatchRequest;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function store(TagRequest $request, Tag $tag)
    {
        $logUser = auth()->user();
        if ($logUser->id != $request->user_id) {
            return response()->json(['error' => "denied"]);
        }
        $tag = $tag->create([
            'Name' => $request->Name,
            'user_id' => $request->userId,

        ]);
        return response()->json([
            'message' => 'tag created successfully ',
            'user' => $tag
        ], 201);
    }

    public function show($user_id, Tag $tag, $id)
    {
        return $tag->find($id);
    }

    public function update(TagPatchRequest $request, Tag $tags, $userId, $id)
    {
        $tag = $tags->find($id);
        $logUser = auth()->user();
        if ($logUser->id != $tag->user_id) {
            return response()->json(['error' => "cannot update to another users tag"]);
        }
        $tagged = $tag->where("id", $id)->update([
            'Name' => $request->Name,
            'user_id' => $request->userId,
        ]);
        return response()->json([
            'message' => 'Succesfully updated',
            'Tag' => $tagged
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, $id)
    {
        $tag = $tag->find($id);
        if ($tag) {
            $tag->delete();
            return response()->json([
                'message' => 'Tag destroyed successfully',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Tag does not exists',
            ], 404);
        }
    }
}
