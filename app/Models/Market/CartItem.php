<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded= ['id'];


    public function user(){

        return $this->belongsTo(User::class);

    }

    public function product(){

        return $this->belongsTo(Product::class);

    }

    public function guarantiee(){

        return $this->belongsTo(Guarantee::class, 'guarante_id');

    }

    public function color(){

        return $this->belongsTo(ProductColor::class);

    }


//product price + guarantiee priceIncrease + color priceIncrease 
    public function cartItemsProductPrice(){

        $cartItemProductPrice = $this->product->price;
        $cartItemGuarantieePriceIncrease = empty($this->guarantiee) ? 0 : $this->guarantiee->price_increase;
        $cartItemColorPriceIncrease = empty($this->color) ? 0 : $this->color->price_increase;
        return $cartItemProductPrice + $cartItemGuarantieePriceIncrease + $cartItemColorPriceIncrease;

    }

//productPrice * (product amazingsales percentage / 100)
    public function cartItemsProductDiscount(){

        $productPrice = $this->cartItemsProductPrice();
        $amazingSalesDiscount = empty($this->product->activeAmazingSales()) ? 0 : $productPrice * ($this->product->activeAmazingSales()->percentage / 100) ;
        return $amazingSalesDiscount;
       
    }

//productNumber * (total productPrices - product Discount) 
    public function cartItemsProductFinalPrice(){

        $totalProductsPrice = $this->cartItemsProductPrice();
        $finalPriceByDiscount = $this->number * ($totalProductsPrice - $this->cartItemsProductDiscount()); 
        return $finalPriceByDiscount ;

    }

//product number * productDiscount
    public function discountProducts(){

        return $this->number * $this->cartItemsProductDiscount();

    }


}
