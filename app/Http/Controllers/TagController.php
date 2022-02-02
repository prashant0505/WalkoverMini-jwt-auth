<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|min:2|max:100',
            'userId' => 'required|exists:Users,id',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
       
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
    public function update(Request $request, Tag $tags,$userId,$id)
    {
        $tag = $tags->find($id);
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|min:2|max:100',
            'userId' => 'required|exists:user,id',
             ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }       
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
