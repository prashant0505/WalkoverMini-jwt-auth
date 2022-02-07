<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public $timestamps = false;

    // Relationships 
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tags');
    }
}
