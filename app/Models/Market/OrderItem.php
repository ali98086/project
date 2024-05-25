<?php

namespace App\Models\Market;

use App\Models\Market\Guarantee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function order(){

        return $this->belongsTo(Order::class);

    }

    public function product(){

        return $this->belongsTo(Product::class, 'product_id');

    }

    public function amazingSale(){

        return $this->belongsTo(AmazingSale::class);

    }

    public function color(){

        return $this->belongsTo(ProductColor::class);

    }

    public function guarantee(){

        return $this->belongsTo(Guarantee::class, 'guarante_id');

    }

    public function orderItemSelectedAttributes(){

        return $this->hasMany(OrderItemSelectedAttribute::class);

    }
}
