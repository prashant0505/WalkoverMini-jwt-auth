<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\company;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserPatchRequest;
use Faker\Provider\ar_EG\Company as Ar_EGCompany;
use Illuminate\Support\Facades\Hash;

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
    public function store(UserRequest $request, Company $company)
    {

        $User = $company->Users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
            // 'company_id'=>$companyId,

        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'User' => $User
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User, $id)
    {
        return $User->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(UserPatchRequest $request, Company $company, $id)
    {

        $User = $company->users()->where("id", $id)->update([
            'Name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
        ]);

        return response()->json([
            'message' => 'User successfully updated',
            'User' => $User
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPatchRequest $request, Company $company, $id)
    {
        $cat = $company->Users()->delete($id);

        return response()->json("deleted");
    }
}
