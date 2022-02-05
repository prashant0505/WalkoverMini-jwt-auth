<?php

namespace App\Observers;

use App\Models\Company;
class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    { 
            $name  = preg_replace("/[^a-zA-Z0-9]/", "", $company->name);
            $admin= $company->users()->create(([
               "name" => $name."admin",
               "salary" => 0,
               "password" => bcrypt($name."admin@123"),
               "email" => $name."admin@gmail.com",
               "company_id"=>$company->id
           ]));
           $company['admin'] = $admin; 
        }

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        //
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}