<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;
    public $timestamps = false;

    // Relationships 
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongsTo(Post::class,"post_id");
    }
}
