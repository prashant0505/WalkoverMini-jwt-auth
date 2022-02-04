<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserPatchRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function store(UserRequest $request, Company $company)
    {

        $user = $company->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
        ]);
        return response()->json([
            'message' => 'User Created Successfully',
            'User' => $user
        ], 201);
    }

    public function show(User $user, $id)
    {
        return $user->find($id);
    }

    public function update(UserPatchRequest $request, Company $company, $id)
    {
        $user = $company->users()->where("id", $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
        ]);

        return response()->json([
            'message' => 'User Updated Successfully',
            'User' => $user
        ], 201);
    }

    public function destroy(UserPatchRequest $request, Company $company, $id)
    {
        $company->users()->find($id)->delete();
        return response()->json("User Deleted");
    }
}
