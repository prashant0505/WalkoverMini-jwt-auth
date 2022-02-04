<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
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
