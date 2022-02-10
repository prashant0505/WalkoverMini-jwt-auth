<?php

namespace App\Http\Controllers;

use App\Services\User\SaveUserService;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Company;
class UserController extends Controller
{
    public function index(IndexUserRequest $request, Company $company){

        return $company->users()->get();
    }

    public function show(ShowUserRequest $request, Company $company, User $user){
        return $user;
    }

    public function store(StoreUserRequest $request, SaveUserService $service, Company $company){
        $user = $service->save($request->validated() ,$company);
        return response()->json([
            'message' => 'User Created Successfully',
            'User' => $user
        ], 201);
    }

    public function update(UpdateUserRequest $request, SaveUserService $service, Company $company, User $user){
        $updated = $service->save($request->validated(), $company , $user);
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
