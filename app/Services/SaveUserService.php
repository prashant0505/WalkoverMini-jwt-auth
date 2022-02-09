<?php

namespace App\Services\User;

use App\Models\Company;
use App\Models\User;

class SaveUserService
{
    public function save(array $para, Company $company){
        $user = $company->users()->create($para);
        return $user;
    }
}