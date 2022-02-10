<?php

namespace App\Services\User;

use App\Models\Company;
use App\Models\User;

class SaveUserService 
{
    public function save(array $para, Company $company , User $user=null){
        if($user==null){
            $create = $company->users()->create($para);
            return $create;
        }else{
            $update = $user->update($para);
            return $update;
        }
        
        
    }
}