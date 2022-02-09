<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Company;
use App\Services\StoreUserService;

class UserController extends Controller
{
    public function index(IndexUserRequest $request, Company $company){
        return $company->users()->get();
    }

    public function show(ShowUserRequest $request, Company $company, User $user){
        return $user;
    }

    public function store(StoreUserRequest $request, StoreUserService $service, Company $company){
        $user = $service->store($request, $company);
        return response()->json([
            'message' => 'User Created Successfully',
            'User' => $user
        ], 201);
    }

    public function update(UpdateUserRequest $request, Company $company, User $user){
        $updated = $user->update($request->validated());
        return response()->json([
            'message' => 'User Updated Successfully',
            'User' => $updated
        ], 201);
    }

    public function destroy(DeleteUserRequest $request, Company $company, User $user){
        if ($user->delete())
            return response()->json(['message' => "User Deleted"]);
    }
}
