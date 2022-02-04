<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyPatchRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Company $company)
    {
        return $company->all();
    }

    public function store(CompanyRequest $request, Company $company)
    {
        $child = $company->parent()->create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'Company Created Succesfully ',
            'company' => $child
        ], 201);
    }

    public function show(Company $company)
    {
        return $company;
    }

    public function companiesUnder(Company $company)
    {
        return $company->with('parent')->where('id', $company->id)->get();
    }

    public function update(CompanyPatchRequest $request, Company $company)
    {
        $com = $company->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        return response()->json([
            'message' => 'Company Updated Successfully',
            'Company' => $com
        ], 201);
    }

    public function destroy(CompanyPatchRequest $request, Company $company)
    {
        $flag = $company->delete();
        if ($flag)
            return response()->json("Company Deleted");
        else
            return response()->json("Company Deleted");
    }
}
