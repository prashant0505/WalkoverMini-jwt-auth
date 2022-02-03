<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyPatchRequest;
use App\Models\Company;
class CompanyController extends Controller
{
    public function store(CompanyRequest $request, Company $company)
    {
        $company = $company->create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'Company Created Succesfully ',
            'company' => $company
        ], 201);
    }

    public function show(Company $Company, $id)
    {
        return $Company->find($id);
    }

    public function update(CompanyPatchRequest $request, Company $company, $id)
    {
        $company = $company->where("id", $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'Company Updated Successfully',
            'Company' => $company
        ], 201);
    }
    
    public function destroy(CompanyPatchRequest $CompPatchrequest, Company $company, $id)
    {
        $company->delete($id);
        return response()->json("Company Deleted");
    }
}
