<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
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
    public function store(CategoryRequest $request,)
    {
        $logUser = auth()->user();
        if($logUser->id != $request->user_id){
            return response()->json(['error'=>"denied{userId}"]);
        }
        $cat=Category::create([
            'Name' => $request->Name,
            'user_id'=>$request->user_id,
        ]);
            return response()->json([
                'message' => 'Category successfully Created',
                'category' => $cat
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId_id,$id)
    {
        return Category::find($id);
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
    public function update(CategoryRequest $request,Category $category,$userId,$id)
    {
        $cat=$category->find($id);
        $logUser = auth()->user();
        if($logUser->id != $cat->user_id){
            return response()->json(['error'=>"cannot update to another users category"]);
        }
            $updatedCategory = $cat->where("id",$id)->update([
            'Name' => $request->Name,
            'user_id'=>$request->user_id,
        ]);
            return response()->json([
                'message' => 'Category successfully Updated',
                'category' => $updatedCategory
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
        $cat = Category::find($id);
        if($cat){
            $cat->delete();
            return response()->json([
            'message' => 'Category destroyed successfully',
            ], 201);
        }
        else {
            return response()->json([
                'message' => 'Category does not exists',
                ], 404);
        }
    }
}
