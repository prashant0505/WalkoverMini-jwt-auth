<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyPatchRequest;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
    public function store(CompanyRequest $request, Company $company)
    {
        $com = $company->create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'Company successfully created',
            'company' => $com
        ], 201);
    }

    public function show($id, Company $company)
    {
        return $company->find($id);
    }

    public function update(CompanyPatchRequest $request, Company $company, $id)
    {
        $com = $company->find($id);
        $updated = $com->where("id", $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'Company successfully updated',
            'company' => $updated
        ], 201);
    }

    public function destroy(Company $company, $id)
    {
        $com = $company->find($id);
        if ($com) {
            $com->delete();
            return response()->json([
                'message' => 'Company destroyed successfully',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Company does not exists',
            ], 404);
        }
    }
}
