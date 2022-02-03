<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Company $company, User $user)

    {
        $count = $company->count();
        if ($count == 0) {
            $company->insert([
                "name" => "Walkover",
                "location" => "Indore",
                "company_id" => 1,
            ]);
        }

        $count = $user->count();
        if ($count == 0) {
            $user->insert([
                "name" => "Shubham Paliwal",
                "salary" => 2000000,
                "password" => bcrypt("shubham@123"),
                "email" => "shubham@gmail.com",
                "company_id" => 1,
            ]);
        }
    }
}
