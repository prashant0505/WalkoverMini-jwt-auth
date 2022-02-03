<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
 
    public function create(Request $request)
    {
        
    }

    
    public function store(Request $request)
    {
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

    
    public function show($id)
    {
        return Company::find($id);
       
    }

    
    public function update(CompanyRequest $request,$id)
    {
        $com=Company::find($id);
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
