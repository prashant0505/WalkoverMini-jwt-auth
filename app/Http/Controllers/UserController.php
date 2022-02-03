<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPatchRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(UserRequest $request, User $user)
    {
        $logUser = auth()->user();
        if ($logUser->company_id != $request->company_id) {
            return response()->json(['error' => "cannot register to another company"]);
        }
        $logUser = auth()->user();
        if ($logUser->company_id != $request->company_id) {
            return response()->json(['error' => "Unauthorized to register in other company"]);
        }
        $user = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
            'company_id' => $request->company_id,
        ]);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function show($company, User $user, $id)
    {
        return $user->find($id);
    }

    public function update(UserPatchRequest $request, User $user, $companyId, $id)
    {
        $us = $user->find($id);

        $logUser = auth()->user();
        if ($logUser->company_id != $us->company_id) {
            return response()->json(['error' => "cannot update to another company"]);
        }

        $us->where("id", $id)->update([
            'Name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary
        ]);
        return response()->json([
            'message' => 'User successfully updated',
            'user' => $us
        ], 201);
    }

    public function destroy(User $user, $companyId, $id)
    {
        $use = $user->find($id);
        if ($use)
            $use->delete();
        else
            return response()->json("User dosn't exist");
        return response()->json("delete");
    }
}
