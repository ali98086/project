<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [

                'source' => 'name'
            ]
        ];
    }

    protected $fillable= ['name','description','slug','image','tags','status','weight','length','width','height','price','marketable','marketable_number','sold_number','frozen_number','brand_id','category_id','published_at'];


    public function productCategory(){

        return $this->belongsTo(ProductCategory::class , 'category_id');

    }

    public function brand(){

        return $this->belongsTo(Brand::class);

    }

    public function metas(){

        return $this->hasMany(ProductMeta::class);

    }

    public function colors(){

        return $this->hasMany(ProductColor::class);

    }

    public function images(){

        return $this->hasMany(ProductGallery::class);

    }

    public function comments(){

        return $this->morphToMany('App\Models\Content\Comment', 'commentable');

    }
}
