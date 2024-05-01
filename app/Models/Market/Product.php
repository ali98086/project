<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    
    protected $fillable= ['name','description','slug','image','tags','status','weight','length','width','height','price','marketable','marketable_number','sold_number','frozen_number','brand_id','category_id','published_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [

                'source' => 'name'
            ]
        ];
    }



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

    public function guarantiees(){

        return $this->hasMany(Guarantee::class);

    }

    public function images(){

        return $this->hasMany(ProductGallery::class);

    }

    public function comments(){

        return $this->morphMany('App\Models\Content\Comment', 'commentable');

    }

    public function activeProductComments(){

        return $this->comments()->where('approved', 1)->where('status', 1)->whereNull('parent_id')->get();

    }

    public function amazingSales(){

        return $this->hasMany(AmazingSale::class);

    }

    public function activeAmazingSales(){

        return $this->amazingSales()->where('status', 1)->where('start_date','<', now())->where('end_date', '>', now())->first();

    }

    public function values(){

        return $this->hasMany(CategoryValue::class);

    }

    public function users(){

        return $this->belongsToMany(User::class);

    }

}
