<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    public function index(){

        $admins= User::where('user_type', 1)->get();
        return view('admin.ticket.admin.index', compact('admins'));

    }


    public function set(User $admin){

        $ticketAdmin= TicketAdmin::where('user_id', $admin->id)->first();
        if($ticketAdmin){

            $ticketAdmin->forceDelete();

        }
        else{

            TicketAdmin::create(['user_id'=>$admin->id]);

        }

        return redirect()->route('admin.ticket.admin.index')->with('swal-success','تغییر ادمین تیکت با موفقیت انجام شد');

    }


}
