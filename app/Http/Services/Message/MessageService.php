<?php


namespace App\Http\Services\Message;

use App\Http\Interfaces\MessageInterface;

class MessageService{

    protected $object;


    public function __construct(MessageInterface $object){

        $this->object= $object;

    }

    public function send(){

        return $this->object->sendMessage();

    }

}


