<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantee extends Model
{
    use HasFactory, SoftDeletes;

    
    public $table= 'guaranties';

    protected $guarded = ['id'];


    public function Product(){

        return $this->belongsTo(Product::class);

    }
}
