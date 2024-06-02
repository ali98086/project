<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index(){

        $tickets= Ticket::whereNull('parent_id')->get();
        return view('admin.ticket.index', compact('tickets'));

    }

    public function newTickets(){

        $tickets = Ticket::where('seen', 0)->get();
        foreach($tickets as $ticket){

            $ticket->seen = 1;
            $ticket->save();

        }
        return view('admin.ticket.index', compact('tickets'));
    }


    public function show(Ticket $ticket){

        return view('admin.ticket.show', compact('ticket'));
    }


    public function openTickets(){

        $tickets = Ticket::where('status' , 0)->get();
        return view('admin.ticket.index', compact('tickets'));

    }


    public function closeTickets(){

        $tickets = Ticket::where('status' , 1)->get();
        return view('admin.ticket.index', compact('tickets')); 

    }

    public function change(Ticket $ticket){

        if($ticket->status == 1){

           $ticket->status = 0 ;
           $ticket->save();
           return redirect()->route('admin.ticket.index')->with('swal-success','تیکت مورد نظر با موفقیت باز شد'); 

        }
        else{

            $ticket->status = 1 ;
            $ticket->save();
            return redirect()->route('admin.ticket.index')->with('swal-success','تیکت مورد نظر با موفقیت بسته شد'); 
 
         }
    }

    public function answer(TicketRequest $request,Ticket $ticket){

        $ticketAdmin= auth()->user()->admin;

        $inputs= $request->all();
        $inputs['subject']= $ticket->subject;
        $inputs['seen']= 1;
        $inputs['user_id']= $ticket->user_id;
        $inputs['reference_id']= $ticketAdmin->id;
        $inputs['parent_id']= $ticket->id;
        $inputs['category_id']= $ticket->category_id;
        $inputs['priority_id']= $ticket->priority_id;

        Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success','تیکت پاسخ با موفقیت ثبت شد');

    }


    }



