<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    
    public function index(){

        $payments = Payment::all();
        return view('admin.market.payment.index', compact('payments'));

    }


    
    public function onlinePayments(){

        $onlinePayments = Payment::where('paymentable_type','App\Models\Market\OnlinePayment')->get(); 
        return view('admin.market.payment.online-payment', compact('onlinePayments'));

    }


    
    public function offlinePayments(){

        $offlinePayments = Payment::where('paymentable_type','App\Models\Market\OfflinePayment')->get();
        return view('admin.market.payment.offline-payment', compact('offlinePayments'));

    }


    
    public function cashPayments(){

        $cashPayments = Payment::where('paymentable_type','App\Models\Market\CashPayment')->get();
        return view('admin.market.payment.cash-payment', compact('cashPayments'));

    }


    
    public function show(Payment $payment){

        return view('admin.market.payment.show', compact('payment'));

    }


    
    public function canceled(Payment $payment){

        $payment->status = 2;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success','وضعیت پرداخت با موفقیت باطل شد');

    }


    
    public function returned(Payment $payment){

        $payment->status = 3;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success','وضعیت پرداخت با موفقیت برگردانده شد');

    }
}
