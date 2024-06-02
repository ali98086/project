<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){

        return view('customer.profile.index');

    }

    public function update(UpdateProfileRequest $request){

        $inputs= [

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code

        ];

        auth()->user()->update($inputs);
        return redirect()->route('customer.profile.index')->with('success', 'پروفایل کاربری شما با موفقیت ویرایش شد');
    }
}
