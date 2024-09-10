<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\FieldsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){

        return view('admin.auth.login');

    }

    public function authenticate(FieldsRequest $request){
        

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){

            $request->session()->regenerate();
            return redirect()->route('admin.home');

        }
        else{

            return back();

        }

    }


    public function logout(Request $request){

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.panel.login');

    }

}
