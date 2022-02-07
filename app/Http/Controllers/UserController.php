<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(IndexUserRequest $request, Company $company)
    {
        return $company->users()->get();
    }

    public function show(ShowUserRequest $request, Company $company, User $user)
    {
        return $user;
    }

    public function store(StoreUserRequest $request, Company $company)
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

    public function update(UpdateUserRequest $request, Company $company, User $user)
    {
        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $updated = $user->update(array_filter($request->all()));
        return response()->json([
            'message' => 'User Updated Successfully',
            'User' => $updated
        ], 201);
    }

    public function destroy(DeleteUserRequest $request, Company $company, User $user)
    {
        if($user->delete())
        return response()->json(['message' => "User Deleted"]);
    }
}
