<?php

namespace App\Http\Controllers;

use App\Http\Requests\company\DeleteCompanyRequest;
use App\Http\Requests\company\IndexCompanyRequest ;
use App\Http\Requests\company\ShowCompanyRequest;
use App\Http\Requests\company\StoreCompanyRequest;
use App\Http\Requests\company\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(IndexCompanyRequest $request)
    {
        $company = Company::find(Auth::user()->company_id);
        return $company->with('children')->where('id', $company->id)->get();   //orWhere('company_id',$company->id)->

    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::find(Auth::user()->company_id)->children()->create($request->validated());

        return response()->json([
            'message' => 'Company Created Succesfully ',
            'company' => $company
        ], 201);
    }

    public function show(ShowCompanyRequest $request, Company $company)
    {
        return $company;
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $updated = $company->update($request->validated());
        return response()->json([
            'message' => 'Company Updated Successfully',
            'Company' => $updated
        ], 201);
    }

    public function destroy(DeleteCompanyRequest $request, Company $company)
    {
        $flag = $company->delete();
        if ($flag)
            return response()->json("Company Deleted");
    }
}