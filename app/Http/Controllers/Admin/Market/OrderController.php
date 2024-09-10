<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;



class OrderController extends Controller
{



    public function newOrders()
    {
        $orders= Order::where('order_status', 0)->get();
        foreach($orders as $order){

            $order->order_status = 1;
            $order->save();

        }
        return view('admin.market.order.order', compact('orders'));
    }




    public function sendingOrders()
    {
        $orders = Order::where('delivery_status', 1)->get();
        return view('admin.market.order.order', compact('orders'));
    }




    public function unpaidOrders()
    {
        $orders = Order::where('payment_status', 1)->get();
        return view('admin.market.order.order' , compact('orders'));
    }




    public function invalidOrders()
    {
        $orders = Order::where('order_status', 3)->get();
        return view('admin.market.order.order', compact('orders'));
    }




    public function returnedOrders()
    {
        $orders = Order::where('order_status', 4)->get();
        return view('admin.market.order.order', compact('orders'));
    }




    public function allOrders()
    {
        $orders= Order::all();
        return view('admin.market.order.order', compact('orders'));
    }




    public function seeFactor(Order $order){

        return view('admin.market.order.show', compact('order'));

    }




    public function details(Order $order){

        return view('admin.market.order.details', compact('order'));

    }




    public function changeStatusSend(Order $order){


        if($order->delivery_status == 0){

            $order->delivery_status = 1;
            $order->save();
            return back();

        }

        if($order->delivery_status == 1){
      
            $order->delivery_status = 2;
            $order->save();
            return back();
            
        }

        if($order->delivery_status == 2){
            
            $order->delivery_status = 3;
            $order->save();
            return back();

        }

        if($order->delivery_status == 3){
            
            $order->delivery_status = 0;
            $order->save();
            return back();

        }


    }




    public function changeStatusOrder(Order $order){

        if($order->order_status == 0){

            $order->order_status = 1;
            $order->save();
            return back();

        }

        if($order->order_status == 1){
      
            $order->order_status = 2;
            $order->save();
            return back();
            
        }

        if($order->order_status == 2){
            
            $order->order_status = 3;
            $order->save();
            return back();

        }

        if($order->order_status == 3){
            
            $order->order_status = 4;
            $order->save();
            return back();

        }

        if($order->order_status == 4){
            
            $order->order_status = 5;
            $order->save();
            return back();

        }

        if($order->order_status == 5){
            
            $order->order_status = 0;
            $order->save();
            return back();

        }

    }




    public function invalidOrder(Order $order){

        $order->order_status = 3;
        $order->save();
        return back();
    }
}
