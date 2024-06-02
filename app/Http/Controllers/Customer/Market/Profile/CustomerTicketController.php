<?php

namespace App\Http\Controllers\Customer\Market\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\StoreTicketRequest;
use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerTicketController extends Controller
{
    public function index(){

        $tickets= Auth::user()->tickets()->whereNull('parent_id')->get();
        return view('customer.profile.tickets.tickets', compact('tickets'));

    }


    public function showTicket(Ticket $ticket){

        return view('customer.profile.tickets.show-ticket', compact('ticket'));

    }


    public function changeStatus(Ticket $ticket){

        if($ticket->status == 0){

            $ticket->status = 1;
            $ticket->save();
            return back()->with('swal-success','وضعیت تیکت مورد نظر با موفقیت تغییر کرد.');

        }

    }


    public function answerTicket(Request $request, Ticket $ticket){

        $request->validate([
            'description'=> 'required|min:2|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹?؟ء-ي., ]+$/u'
        ]);

        $inputs= $request->all();

        $inputs= $request->all();
        $inputs['subject']= $ticket->subject;
        $inputs['seen']= 0;
        $inputs['user_id']= auth()->user()->id;
        $inputs['reference_id']= $ticket->reference_id;
        $inputs['parent_id']= $ticket->id;
        $inputs['category_id']= $ticket->category_id;
        $inputs['priority_id']= $ticket->priority_id;

        Ticket::create($inputs);
        return redirect()->back()->with('swal-success','تیکت پاسخ با موفقیت ثبت شد');

    }


    public function createTicket(){

        $ticketCategories= TicketCategory::all();
        $ticketPriorities= TicketPriority::all();
        return view('customer.profile.tickets.create', compact('ticketCategories','ticketPriorities'));
        
    }


    public function storeTicket(StoreTicketRequest $request, FileService $fileService){


        DB::transaction(function() use ($request , $fileService){


        $inputs= $request->all();
        $inputs['user_id']= auth()->user()->id;

        $newTicket= Ticket::create($inputs);


        if($request->hasFile('file')){

                $fileService->checkExistsDirectory(public_path('files'.DIRECTORY_SEPARATOR.'ticket'.DIRECTORY_SEPARATOR));
                $fileService->setPathFile('files'.DIRECTORY_SEPARATOR.'ticket'.DIRECTORY_SEPARATOR);
                $fileService->setNameFile($request->file('file'));
                $fileService->saveFileToPublic($request->file('file'));
                $fullFilePath= $fileService->fullPath();

                $inputs['file_path']= $fullFilePath;
                $inputs['file_size']= $fileService->getSizeFile($fullFilePath);
                $inputs['file_type']= $fileService->getFormatFile($request->file('file'));
                $inputs['user_id']= auth()->user()->id;
                $inputs['ticket_id']= $newTicket->id;
        
                TicketFile::create($inputs);

            }

        });

        return to_route('customer.profile.ticket.index');

    }


    public function download(Ticket $ticket){

        $ticketFilePath = $ticket->file->file_path;
        return response()->download(public_path($ticketFilePath));

    }


}
