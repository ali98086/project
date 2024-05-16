<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){

        if(Auth::check()){

            $user = auth()->user();
            $cartItems= CartItem::where('user_id', Auth::user()->id)->get();
            return view('customer.salesProcess.profile' , compact('user','cartItems'));

        }
        else{

            return redirect()->route('auth.customer.login-register-form');

        }


    }

    public function completeProfile(Request $request){

        $request->validate([

            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'email' => 'sometimes|nullable|email|unique:users,email',
            'mobile' => 'sometimes|nullable|min:10|max:13|unique:users,mobile',
            'national_code' => 'sometimes|required|min:10|max:10|unique:users,national_code',

        ]);

        $inputs= $request->all();

        Auth::user()->update($inputs);

        return redirect()->route('customer.salesProcess.address-and-delivery');

    }

}
