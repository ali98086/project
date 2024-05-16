<?php

namespace App\Http\Controllers\Customer\Market\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function cart()
    {

        if(auth()->check()){

            $cartItems= CartItem::where('user_id', Auth::user()->id)->get();
            $relatedProducts= Product::all();
            return view('customer.salesProcess.cart', compact('cartItems','relatedProducts'));

        }
        else{

            return redirect()->route('auth.customer.login-register-form');

        }
    }



    public function updateCart(Request $request)
    {
        if(auth()->check()){

        $inputs = $request->all();
        $cartItems = CartItem::where('user_id' , auth()->user()->id)->get();

        foreach($cartItems as $cartItem){

            if($cartItem->number != $inputs['number'][$cartItem->id]){

                $cartItem->update(['number' => $inputs['number'][$cartItem->id]]);

            }
        }

        return redirect()->route('customer.salesProcess.address-and-delivery');

        }
        else{
            
            return back();

        }
        

    }



    public function addToCart(Product $product, Request $request)
    {


        if (Auth::check()) {

            $request->validate([

                'color' => ['nullable', 'exists:product_colors,id'],
                'guarantiee' => ['nullable', 'exists:guaranties,id'],
                'number' => ['numeric', 'min:1', "max:$product->marketable_number"]

            ]);

            $inputs = $request->all();

            if (!isset($request->color)) {

                $inputs['color_id'] = null;
            }

            if (!isset($request->guarantiee)) {

                $inputs['guarante_id'] = null;
            }

            //check cartItem for not repeat add product for sale

            $cartItems = CartItem::where('product_id', $product->id)->where('user_id', auth()->user()->id)->get();

            $item= true;
            
            if(!$cartItems->isEmpty()){

            foreach ($cartItems as $cartItem) {

                if ($cartItem->color_id == $request->color && $cartItem->guarante_id == $request->guarantiee) {

                    if ($cartItem->number != $request->number) {

                        $cartItem->update(['number' => $request->number]);
                        return back();

                    } else {

                        return back()->with('alert-message-error','سفارش تکراری بوده و در سبد خرید موجود می باشد!');
                    }
                }
                else{

                    $item = false;
                    continue;

                }
            }
        }
        
                if($cartItems->isEmpty() || $item == false){

                    $inputs['user_id']= Auth::user()->id;
                    $inputs['product_id']= $product->id; 
                    $inputs['color_id']= $request->color;
                    $inputs['guarante_id']= $request->guarantiee;

                    CartItem::create($inputs); 
                    return back()->with('alert-message-success','محصول مورد نظر با موفقیت به سبد خرید افزوده شد.');

                }

        }
        else{

            return redirect()->route('auth.customer.login-register-form');

        }
    }


    public function removeFromCart(CartItem $cartItem)
    {

        if(Auth::check() && $cartItem->user_id == auth()->user()->id){

            $cartItem->forceDelete();
            return back();

        }

        else{

            return redirect()->route('auth.customer.login-register-form');

        }


    }
}
