<?php

namespace App\Http\Controllers\Customer\Market\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Market\ChooseAddressDeliveryRequest;
use App\Http\Requests\Customer\Market\StoreAddressRequest;
use App\Http\Requests\Customer\Market\UpdateAddressRequest;
use App\Models\Address;
use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressAndDelivery(){

        if(Auth::check()){

            $user = Auth::user();
            $cartItems= CartItem::where('user_id', Auth::user()->id)->get();
            $provinces = Province::all();
            $deliveries = Delivery::where('status', 1)->get();
            
            if(empty(CartItem::where('user_id', $user->id)->count())){

                return redirect()->route('customer.salesProcess.cart');

            }
            else{

                return view('customer.salesProcess.address-and-delivery', compact('cartItems','provinces','deliveries'));

            }

        }

    }


    public function getCities(Province $province){

        $cities= $province->cities;

        if(!empty($cities)){

            return response()->json(['status'=> true , 'cities' => $cities]);

        }
        else{

            return response()->json(['status'=> false , 'cities' => null]);

        }

    }



    public function addAddress(StoreAddressRequest $request){

        $inputs = $request->all();

        $inputs['user_id'] = Auth::user()->id;

        Address::create($inputs);

        return back();

    }


    public function updateAddress(Address $address, UpdateAddressRequest $request){

        $inputs = $request->all();
        $inputs['user_id']= auth()->user()->id;
        $update= $address->update($inputs);
        if($update){

            return back();

        }
    }


    public function chooseAddressDelivery(ChooseAddressDeliveryRequest $request){

        $inputs= $request->all();
        $user= Auth::user();

        //calc price
        $cartItems= CartItem::where('user_id',$user->id)->get();

        $totalProductPrice = 0;
        $productDiscount = 0;
        $finalProductPrice = 0;
        $totalProductDiscount = 0;

        foreach($cartItems as $cartItem){

            $totalProductPrice += $cartItem->cartItemsProductPrice();
            $productDiscount += $cartItem->cartItemsProductDiscount();
            $finalProductPrice += $cartItem->cartItemsProductFinalPrice();
            $totalProductDiscount += $cartItem->discountProducts();

        }

        //calc common discount

        $commonDiscount = CommonDiscount::where('status',1)->where('start_date','<',now())->where('end_date','>',now())->first();

        if(!empty($commonDiscount)){

            $commonDiscountProductAmount = $finalProductPrice * ($commonDiscount->percentage / 100);

            if($commonDiscountProductAmount > $commonDiscount->discount_ceiling){

                $commonDiscountProductAmount = $commonDiscount->discount_ceiling;

            }

            if($finalProductPrice >= $commonDiscount->minimal_order_amount){

                $finalOrderAmountPrice = $finalProductPrice - $commonDiscountProductAmount;

            }

            else{

                $finalOrderAmountPrice = $finalProductPrice;

            }

        }
        else{

            $commonDiscountProductAmount = null;
            $finalOrderAmountPrice = $finalProductPrice;
        }


        $inputs['user_id'] = $user->id;
        $inputs['order_final_amount'] = $finalOrderAmountPrice - $totalProductDiscount;
        $inputs['order_discount_amount'] = $totalProductDiscount;
        $inputs['order_common_discount_amount'] = $commonDiscountProductAmount;
        $inputs['common_discount_id'] = $commonDiscount->id;
        $inputs['order_total_products_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_common_discount_amount'];

        Order::updateOrCreate(['user_id'=> $user->id,'order_status'=> 0] , $inputs);

        return redirect()->route('customer.salesProcess.payment');

    }





}
