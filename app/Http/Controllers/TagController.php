<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Requests\TagPatchRequest;
use App\Models\Tag;

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
    public function create(TagRequest $request,User $user)
    {   
       
        $Tag = $user->tags()->create([
            'name' => $request->name,
            //'user_id' => $request->userId,
         
            ]);

        return response()->json([
            'message' => 'Tag created successfully ',
            'user' => $Tag
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $Tag,$userId,$id)
    {
        return $Tag->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $Tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagPatchRequest $request,User $user,$id)
    {   
       
        $Tag = $user->tags()->where("id", $id)->update([
            'Name' => $request->Name,
            'user_id' => $request->userId,
                          ]);

        return response()->json([
            'message' => 'Succesfully updated',
            'user' => $Tag
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagPatchRequest $request,User $user ,$userId,$id)
    {
        $cat=$user->tags()->delete($id);

        return response()->json("deleted"); 
    }
}