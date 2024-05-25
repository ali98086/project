<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function addresses(){

        $addresses= Address::where('user_id',auth()->user()->id)->get();
        $provinces = Province::all();

        return view('customer.profile.addresses', compact('addresses','provinces'));

    }
}
