<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps = false;

    // Relationships
    public function users(){
        return $this->hasMany(User::class);
    }

    public function parent(){
        return $this->hasMany(Company::class,'company_id');
    }
    
    public function children(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
