<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable() :array
    {

        return [

            'slug' => [
                'source' => 'title'
            ]

        ];
    }

    protected $fillable= ['title','body','summary','image','slug','tags','status','commentable','author_id','category_id','published_at'];


    public function postCategory(){

        return $this->belongsTo(PostCategory::class, 'category_id');

    }


}
