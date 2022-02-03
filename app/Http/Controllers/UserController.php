<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function create(UserRequest $request)
    {
        $logUser = auth()->user();
        if($logUser->company_id != $request->company_id){
            return response()->json(['error'=>"Unauthorized to register in other company"]);
        }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
                'salary'=>$request->salary,
                'company_id'=>$request->company_id,
            ]);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user,$companyId,$id)
    {
        $us = $user->find($id);
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|min:2|max:100',
        //     'email' => 'required|string|email|max:100',
        //     'password' => 'required|string|min:6',
        //     'salary'=> 'required|integer|min:3'
        // ]);
        // if($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }
       
        $us->where("id", $id)->update([
                'Name' => $request->name,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
                'salary'=>$request->salary            
            ]);
        return response()->json([
            'message' => 'User successfully updated',
            'user' => $us
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$companyId,$id)
    {
        $use = $user->find($id);
        if($use)
           $use->delete(); 
        else
            return response()->json("User dosn't exist");
        return response()->json("delete");
    }
}
