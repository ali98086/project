<?php


namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;
use Exception;
use Illuminate\Support\Facades\Config;
use Melipayamak\MelipayamakApi;

class smsService implements MessageInterface{


    protected $from;
    protected $text;
    protected $to;
    protected $isFlash = true;



    public function sendMessage()
    {
        try{

            $meliPayamak= new MelipayamakApi(Config::get('sms.username'), Config::get('sms.password'));
            $sms= $meliPayamak->sms();
            $from= $this->getFrom();
            $text= $this->getText();
            $to= $this->getTo();
            $isFlash= $this->getIsFlash();
            $sendResponse= $sms->send($to,$from,$text,$isFlash);
            $json = json_decode($sendResponse);
            echo $json->Value;

        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }


    public function setFrom($from){

        $this->from= $from;

    }

    public function getFrom(){

        return $this->from;

    }

    public function setText($text){

        $this->text= $text;

    }

    public function getText(){

        return $this->text;

    }

    public function setTo($to){

        $this->to= $to;

    }

    public function getTo(){

        return $this->to;

    }

    public function setIsFlash($isFlash){

        $this->isFlash= $isFlash;

    }

    public function getIsFlash(){

        return $this->isFlash;

    }

}