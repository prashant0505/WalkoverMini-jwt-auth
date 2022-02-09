<?php

namespace App\Services;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserService
{

    public function store(StoreUserRequest $request, Company $company): User
    {
        $user = $company->users()->create($request->validated());
        return $user;
    }
}
