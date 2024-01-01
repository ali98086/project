<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function newTickets(){

        return view('admin.ticket.new-tickets');
    }


    public function showTickets(){

        return view('admin.ticket.show-tickets');
    }


    public function openTickets(){

        return view('admin.ticket.open-tickets');
    }



    public function closeTickets(){

        return view('admin.ticket.close-tickets'); 
    }


}
