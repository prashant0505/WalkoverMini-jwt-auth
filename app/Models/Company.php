<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public $timestamps = false;
    

    // Relationships
    public function users(){
        return $this->hasMany(User::class,'company_id');
    }

    public function children(){
        return $this->hasMany(Company::class,'company_id');
    }
    
    public function parent(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
