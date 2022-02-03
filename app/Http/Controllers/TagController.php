<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
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
    public function store(TagRequest $request)
    {
        $tag = Tag::create([
            'Name' => $request->Name,
            'user_id' => $request->userId,
         
            ]);
        return response()->json([
            'message' => 'tag created successfully ',
            'user' => $tag
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
    public function update(TagRequest $request, Tag $tags,$userId,$id)
    {
        $tag = $tags->find($id);       
        $tagged=$tag->where("id", $id)->update([
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
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            return response()->json([
            'message' => 'Tag destroyed successfully',
            ], 201);
        }
        else {
            return response()->json([
                'message' => 'Tag does not exists',
                ], 404);
        }
    }
}
