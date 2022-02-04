<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCompanyRequest;
use App\Http\Requests\GetAllCompanyRequest;
use App\Http\Requests\GetCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(GetAllCompanyRequest $request, Company $company)
    {
        return $company->all();
    }

    public function store(StoreCompanyRequest $request, Company $company)
    {
        $company = $company->children()->create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        $userid = $company->id;
        $company->users()->create(([
            "name" => $request->name . "Admin",
            "salary" => 0,
            "password" => bcrypt("Admin@123"),
            "email" => $request->name . "Admin@gmail.com",
            "company_id" => $userid,
        ]));

        return response()->json([
            'message' => 'Company Created Succesfully ',
            'company' => $company
        ], 201);
    }

    public function show(GetCompanyRequest $request, Company $company)
    {
        return $company;
    }

    public function companiesUnder(GetCompanyRequest $request, Company $company)
    {
        return $company->with('children')->where('id', $company->id)->get();
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $com = $company->update($request->all());
        return response()->json([
            'message' => 'Company Updated Successfully',
            'Company' => $com
        ], 201);
    }

    public function destroy(DeleteCompanyRequest $request, Company $company)
    {
        $flag = $company->delete();
        if ($flag)
            return response()->json("Company Deleted");
        else
            return response()->json("Company cannot be Deleted");
    }
}
