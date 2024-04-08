<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array{

        return [

            'slug'=> [

                'source'=>'orginal_name'
            ]

        ];

    }

    protected $fillable= ['persian_name','orginal_name','slug','tags','logo','status'];

    public function products(){

        return $this->hasMany(Product::class);

    }
}
