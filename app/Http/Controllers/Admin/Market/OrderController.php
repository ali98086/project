<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function newOrders()
    {
        return view('admin.market.order.new-order');
    }

    public function sendingOrders()
    {
        return view('admin.market.order.sending-order');
    }

    public function unpaidOrders()
    {
        return view('admin.market.order.unpaid-order');
    }

    public function invalidOrders()
    {
        return view('admin.market.order.invalid-order');
    }

    public function returnedOrders()
    {
        return view('admin.market.order.returned-order');
    }


    public function allOrders()
    {
        return view('admin.market.order.order');
    }

    public function seeFactor(){

    }

    public function changeStateSend(){

    }

    public function changeStateOrder(){

    }

    public function invalidOrder(){

    }
}
