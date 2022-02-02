<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
            'name' => 'required|string|min:2|max:100',
            'location'=>'required|string|min:3',
            'company_id' => 'exists:companies,id'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
            $company=Company::create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id'=>$request->company_id,
        ]);
            return response()->json([
                'message' => 'Company successfully created',
                'company' => $company
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
        return Company::find($id);
       
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
    public function update(Request $request,$id)
    {
        $com=Company::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'location'=>'required|string|min:3',
            'company_id' => 'required|exists:companies,id'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
            $com->where("id",$id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'company_id'=>$request->company_id,
        ]);
            return response()->json([
                'message' => 'Company successfully updated',
                'company' => $com
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
        $com = Company::find($id);
        if($com){
            $com->delete();
            return response()->json([
            'message' => 'Company destroyed successfully',
            ], 201);
        }
        else {
            return response()->json([
                'message' => 'Company does not exists',
                ], 404);
        }
    }
}
