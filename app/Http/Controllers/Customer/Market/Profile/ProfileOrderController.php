<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class ProfileOrderController extends Controller
{
    public function index(){

        if(isset(request()->type)){

            // $orders= auth()->user()->orders()->where('order_status', request()->type)->orderBy('id','desc')->get();
            //or
            $orders= Order::where('user_id', auth()->user()->id)->where('order_status', request()->type)->orderBy('id','desc')->get();
            // foreach($orders as $order){
            //     foreach($order->orderItems as $orderItem){
            //         $image = $orderItem->product->image;
            //     }
            // }

        }else{

            $orders= auth()->user()->orders()->orderBy('id','desc')->get();

        }
        
        return view('customer.profile.profile-order', compact('orders'));

    }
}
