<?php

namespace App\Http\Controllers\Customer\Market\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Copan;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(){

        if(Auth::check()){

            $cartItems= CartItem::where('user_id', auth()->user()->id)->get();
            $order= Order::where('user_id', auth()->user()->id)->where('order_status', 0)->first();

            return view('customer.salesProcess.payment', compact('cartItems', 'order'));

        }
        else{

            return redirect()->route('auth.customer.login-register-form');

        }


    }

    public function copanDiscount(Request $request){


        $copan = Copan::where('code', $request->code)->where('status',1)->where('start_date','<',now())->where('end_date','>',now())->first();

        if(!empty($copan)){

            //if copan is private
            if($copan->user_id != null){

                $copan= Copan::where('code', $request->code)->where('status',1)->where('user_id', auth()->user()->id)->where('start_date','<',now())->where('end_date','>',now())->first();
              
                // if($copan == null){

                //     return back()->with(['copan-null','aaaaaaaاین کد تخفیف وجود ندارد']);

                // }
            }
            else{

                $order= Order::where('copan_id', null)->where('order_status', 0)->where('user_id', Auth::user()->id)->first();

                if($order){

                    //if copan type is percentage (%)
                    if($copan->amount_type == 0){

                        $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);
                        
                        if($copanDiscountAmount > $copan->discount_ceiling){

                            $copanDiscountAmount = $copan->discount_ceiling;

                        }

                    }
                    else{

                        $copanDiscountAmount = $copan->amount;

                    }

                    $order->order_final_amount = $order->order_final_amount - $copanDiscountAmount;
                    $totalDiscountAmount = $order->order_total_products_discount_amount + $copanDiscountAmount;

                    $order->update([

                        'copan_id' => $copan->id,
                        'order_copan_discount_amount' => $copanDiscountAmount,
                        'order_total_products_discount_amount' => $totalDiscountAmount

                    ]);

                    return back()->with(['success'=>'کد تخفیف با موفقیت اعمال شد.']);

                }
                else{

                    return back();

                }

            }
            
        }
        else{

            return back()->with('copan-null','این کد تخفیف معتبر نیست.');

        }

    }


    public function paymentSubmit(Request $request){

        $request->validate(['payment_type' => 'required']);

        if(Auth::check()){

            $cartItems= CartItem::where('user_id', auth()->user()->id)->get();
            $order= Order::where('user_id', auth()->user()->id)->where('order_status', 0)->first();

            if($request->payment_type == 0){

                $targetModel= OnlinePayment::class;
                $type= 0; 

            }
            if($request->payment_type == 1){

                $targetModel= OfflinePayment::class;
                $type= 1; 

            }
            if($request->payment_type == 2){

                $targetModel= CashPayment::class;
                $receiver_name = $request->receiver_name;
                $type= 2; 

            }

            if($targetModel == CashPayment::class){
                
                $payment = $targetModel::create([

                    'amount_price' => $order->order_final_amount,
                    'receiver_name' => $receiver_name,
                    'user_id' => auth()->user()->id,
                    'status'=> 1,
                    'pay_date' => now()
    
                ]);
            }else{

                $payment = $targetModel::create([

                    'amount_price' => $order->order_final_amount,
                    'user_id' => auth()->user()->id,
                    'status'=> 1,
                    'pay_date' => now()
    
                ]);

            }

            Payment::create([

                'user_id'=>auth()->user()->id,
                'status'=> 1,
                'type' => $type,
                'paymentable_id'=> $payment->id,
                'paymentable_type'=> $targetModel,
                'pay_date'=> now(),
                'amount_price' => $order->order_final_amount

            ]);


            $order->update(['order_status' => 2]);

            foreach($cartItems as $cartItem){

                OrderItem::create([

                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_object'=> $cartItem->product,
                    'number' => $cartItem->number,
                    'amazing_sale_id' => $cartItem->product->activeAmazingSales()->id ?? null,
                    'amazing_sale_object' =>$cartItem->product->activeAmazingSales() ?? null,
                    'amazing_sale_discount_amount' =>empty($cartItem->product->activeAmazingSales()) ? 0 : ($cartItem->cartItemsProductDiscount() * $cartItem->number),
                    'final_product_price'=> $cartItem->product->activeAmazingSales() ? $cartItem->cartItemsProductPrice() - ($cartItem->cartItemsProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)) :  $cartItem->cartItemsProductPrice(),
                    'final_total_price' => $cartItem->product->activeAmazingSales() ? $cartItem->number * ($cartItem->cartItemsProductPrice() - ($cartItem->cartItemsProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100))) :  $cartItem->number * $cartItem->cartItemsProductPrice(),
                    'guarante_id' => $cartItem->guarante_id ?? null,
                    'color_id' => $cartItem->color_id ?? null

                ]);

                $cartItem->delete();

            }

            return redirect()->route('customer.home')->with('success','سفارش شما با موفقیت ثبت شد.');

        }
        else{

            return redirect()->route('auth.customer.login-register-form');

        }
    }
}
