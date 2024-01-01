<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){

        return view('admin.market.payment.index');

    }

    public function onlinePayments(){

        return view('admin.market.payment.online-payment');

    }

    public function offlinePayments(){

        return view('admin.market.payment.offline-payment');

    }

    public function attendance(){



    }

    public function confirm(){



    }
}
