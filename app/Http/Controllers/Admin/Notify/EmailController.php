<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Jobs\SendMailToUsers;
use App\Models\Notify\Email;
use App\Models\User\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails= Email::orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.notify.email.index', compact('emails'));
    }



    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notify.email.create');
    }



    
    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailRequest $request)
    {
        $inputs = $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success','اطلاعیه ایمیلی مورد نظر با موفقیت ثبت شد');
    }



    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit', compact('email'));
    }



    
    /**
     * Update the specified resource in storage.
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();
        $realTimeStampStart= substr($request->published_at, 0, 10);
        $inputs['published_at']= date('Y-m-d H:i:s', $realTimeStampStart);

        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success','اطلاعیه ایمیلی مورد نظر با موفقیت ویرایش شد');
    }



    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success','اطلاعیه ایمیلی مورد نظر با موفقیت حذف شد');
    }



    
    public function status(Email $email){

        $email->status= $email->status == 0 ? 1 : 0 ;
        $result= $email->save();

        if($result){
            if($email->status == 0){

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



    
    public function sendMail(Email $email){

            SendMailToUsers::dispatch($email);
            return redirect()->route('admin.notify.email.index')->with('swal-success','اطلاعیه ایمیلی مورد نظر با موفقیت ارسال شد');
    }
}