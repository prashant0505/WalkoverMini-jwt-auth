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
    public function run(Company $company)

    {
        $count = $company->count();
        if ($count == 0) {
            $company->create([
                "name" => "Walkover",
                "location" => "Indore",
            ]);
        }
    }
}
