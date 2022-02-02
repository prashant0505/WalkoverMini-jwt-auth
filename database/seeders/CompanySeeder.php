<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker= Faker::create();
         $count = DB::table('companies')->count();
         if($count == 0) {
         DB::table("companies")->insert([
             "Name" => $faker->name(),
             "location"=>$faker->address(),
             "company_id"=>1,
         ]);
        }

         $count = DB::table('users')->count();
         if($count == 0) {
         DB::table("users")->insert([
             "Name" => $faker->name(),
             "salary" => $faker->numerify('###'),
             "password" =>bcrypt("12345678"),
             "email"=>$faker->email(),
             "company_id"=>1,
         ]);
        }
    }
}       
