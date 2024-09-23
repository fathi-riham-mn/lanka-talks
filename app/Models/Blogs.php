<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'tl_blogs';
    use HasFactory;


    public function user(){
        return $this->belongsTo(Users::class,'user_id','id');
    }

    public function get_ID(){
        return $this->hasMany(BlogCategory::class,'blog_id','id');
    }
}