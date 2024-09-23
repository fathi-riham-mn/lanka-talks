<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'tl_blogs_categories';

    public function category(){
        return $this->belongsTo(Categories::class,'category_id','id');
    }
}