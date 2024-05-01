<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\SMS\smsService;
use App\Http\Services\Message\MessageService;
use App\Models\Otp;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{


    public function LoginRegisterForm(){

        return view('customer.auth.loginRegister');

    } 


    public function LoginRegister(LoginRegisterRequest $request){

        $inputs = $request->all();

        //if field is email

        if(filter_var($inputs['field'] , FILTER_VALIDATE_EMAIL)){

            // 1 = email

            $type = 1; 
            $user= User::where('email' , $inputs['field'])->first();
            if(empty($user)){

                $newUser['email'] = $inputs['field'];
            }
        }
        //else if field is mobile

        elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['field'])){

            //type 0 = mobile

            $type = 0;

            //set format mobile number

            $inputs['field']= ltrim($inputs['field'], 0);   //remove 0 of first number mobile
            $inputs['field']= substr($inputs['field'], 0 , 2) === '98' ? substr($inputs['field'], 2) : $inputs['field'];    //if 98 is first of mobile number, remove it
            $inputs['field']= str_replace('+98', '', $inputs['field']);
            $user= User::where('mobile' , $inputs['field'])->first();
            if(empty($user)){

                $newUser['mobile'] = $inputs['field'];
            }
        }
            else{

                $errorMessage= 'فیلد وارد شده موبایل یا پست الکترونیک نمی باشد';
                return redirect()->route('auth.customer.login-register-form')->withErrors(['field'=> $errorMessage]);

            }

        if(empty($user)){

            $newUser['password'] = '4557'; //default password
            $newUser['activation'] = 1;
            $user= User::create($newUser);

        }

        //create otp

        $token= Str::random(60); //generate a random token for authenticate new registered user
        $otp_code= rand(111111 , 999999);   //generate a random code 
        $login_field= $inputs['field'];
        $newOpt= [

            'token'=> $token,
            'user_id'=> $user->id,
            'otp_code'=> $otp_code,
            'login_field'=> $login_field,
            'type'=> $type

        ];

        $newOtp= Otp::create($newOpt);


        //if 1 send sms otp code to mobile 

        if($type == 0){

            $sms= new smsService();
            $sms->setFrom(Config::get('sms.otp_from'));
            $sms->setText("سایت فروشگاهی آمازون \n کد تایید : $otp_code");
            $sms->setTo("0.$user->mobile");
            $sms->setIsFlash(true);
            $messageService= new MessageService($sms);

        }
        //if 0 send email otp code

        elseif($type == 1){

            $emailService= new EmailService();
            $contents= ['title'=> 'ایمیل فعالسازی' ,'body'=>"کد فعال سازی شما : $otp_code"];
            $emailService->setContents($contents);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo([$inputs['field']]);

            $messageService= new MessageService($emailService);

        }

        $messageService->send();

        return redirect()->route('auth.customer.login-register-confirm' , $newOtp->token);

    }


    public function LoginRegisterConfirm($token){

        $otp = Otp::where('token', $token)->first();

        if(empty($otp)){

            return redirect()->route('customer.auth.login-register-form')->withErrors(['field' => 'آدرس وارد شده نامعتبر می باشد']);

        }

        return view('customer.auth.loginConfirm', compact('token' , 'otp'));

    }


    public function LoginConfirm($token, LoginRegisterRequest $request){

        $inputs= $request->all();

        $otp= Otp::where('token', $token)->where('used', 0)->where('created_at','>=', now()->subMinute(5)->toDateTimeString())->first();

        if(empty($otp)){

            return redirect()->route('auth.customer.login-register-form')->withErrors(['field'=>'آدرس وارد شده نامعتبر می باشد']);

        }

        if($otp->otp_code !== $inputs['otp_code']){

            return redirect()->route('auth.customer.login-register-confirm', $token)->withErrors(['otp_code'=>'کد تایید وارد شده صحیح نمی باشد !']);

        }

        //if otp ok

        $otp->update(['used' => 1]);
        $user = $otp->user()->first();

        if($otp->type == 0  && empty($user->mobile_verified_at)){

            $user->update(['mobile_verified_at' => now()]);

        }
        elseif($otp->type == 1 && empty($user->email_verified_at)){

            $user->update(['email_verified_at' => now()]);

        }

        Auth::login($user);
       
        return redirect()->route('customer.home');

    }


    public function resendOtp($token){


        $otp= Otp::where('token', $token)->where('created_at','<=', now()->subMinute(5)->toDateTimeString())->first();

        if(empty($otp)){

            return redirect()->route('auth.customer.login-register-form');

        }

        $token= Str::random(60); //generate a random token for authenticate new registered user
        $otp_code= rand(111111 , 999999);   //generate a random code 

        $newOpt= [

            'token'=> $token,
            'user_id'=> $otp->user_id,
            'otp_code'=> $otp_code,
            'login_field'=> $otp->login_field,
            'type'=> $otp->type

        ];

        $newOtp= Otp::create($newOpt);


        //if 1 send sms otp code to mobile 

        if($otp->type == 0){

            $sms= new smsService();
            $sms->setFrom(Config::get('sms.otp_from'));
            $sms->setText("سایت فروشگاهی آمازون \n کد تایید : $otp_code");
            $sms->setTo("0.$otp->user->mobile");
            $sms->setIsFlash(true);
            $messageService= new MessageService($sms);

        }
        //if 0 send email otp code

        elseif($otp->type == 1){

            $emailService= new EmailService();
            $contents= ['title'=> 'ایمیل فعالسازی' ,'body'=>"کد فعال سازی شما : $otp_code"];
            $emailService->setContents($contents);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo([$otp->login_field]);

            $messageService= new MessageService($emailService);

        }

        $messageService->send();

        return redirect()->route('auth.customer.login-register-confirm' , $token);

    }


    public function logout(){

        Auth::logout();
        return redirect()->route('auth.customer.login-register-form'); 

    }

}
