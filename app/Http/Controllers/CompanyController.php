<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyPatchRequest;

use App\Models\Company;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use JWTAuth;
use Hash;

class CompanyController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(CompanyRequest $request, Company $company)
    {


        $company = $company->create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->Company_id,
        ]);
        return response()->json([
            'message' => 'Company successfully created',
            'Company' => $company
        ], 201);
    }

    public function show(Company $Company, $id)
    {
        return $Company->find($id);
    }

    public function edit(Company $Company)
    {
        //
    }

    public function update(CompanyPatchRequest $request, Company $company, $id)
    {


        $company = $company->where("id", $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'Company_id' => $request->Company_id,
        ]);
        return response()->json([
            'message' => 'Company successfully updated',
            'Company' => $company
        ], 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPatchRequest $CompPatchrequest, Company $Company, $id)
    {
        $cat = $Company->delete($id);
        return response()->json("deleted");
    }
}
