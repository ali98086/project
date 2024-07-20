<?php


namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface{


    protected $contents = [];
    protected $from = [];
    protected $subject;
    protected $to = [];
    protected $emailFiles= [];


    public function sendMessage()
    {

        Mail::to($this->to)->send(new EmailViewProvider($this->contents, $this->emailFiles));
        return true;

    }


    public function setContents($contents){

        $this->contents['title']= $contents['title'];
        $this->contents['body']= $contents['body'];
    }


    public function getContents(){

        return $this->contents;

    }

    public function setFrom($address , $name){

        $this->from= ['address'=> $address, 'name'=> $name];

    }


    public function getFrom(){

        return $this->from;

    }

    public function setSubject($subject){

        $this->subject= $subject;

    }


    public function getSubject(){

        return $this->subject;

    }

    public function setTo($to){

        $this->to= $to;

    }

    public function getTo(){

        return $this->to;

    }

    public function setEmailFiles($emailFiles){

        $this->emailFiles= $emailFiles;

    }

    public function getEmailFiles(){

        return $this->emailFiles;

    }
}