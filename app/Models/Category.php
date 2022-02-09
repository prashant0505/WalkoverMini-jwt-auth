<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;
    use SoftDeletes;

    // Relationships
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
