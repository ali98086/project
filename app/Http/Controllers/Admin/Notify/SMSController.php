<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Jobs\SendSmsToUsers;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;


class SMSController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSms= SMS::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.notify.sms.index', compact('allSms'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notify.sms.create');
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(SMSRequest $request)
    {
        $inputs = $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success','اطلاعیه پیامکی مورد نظر با موفقیت ثبت شد');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success','اطلاعیه پیامکی مورد نظر با موفقیت ویرایش شد');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMS $sms)
    {
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('swal-success','اطلاعیه پیامکی مورد نظر با موفقیت حذف شد');
    }




    public function status(SMS $sms){

        $sms->status= $sms->status == 0 ? 1 : 0 ;
        $result= $sms->save();

        if($result){
            if($sms->status == 0){

                return response()->json(['status'=> true , 'checked'=> false]);

            }
            else{

                return response()->json(['status'=> true , 'checked'=>true]);

            }
        }
        else{

            return response()->json(['status'=> false]);

        }

    }



    public function sendSms(SMS $sms){

        SendSmsToUsers::dispatch($sms);
        return redirect()->route('admin.notify.sms.index')->with('swal-success','اطلاعیه پیامکی مورد نظر با موفقیت ارسال شد');
}
}
