<?php

namespace App\Jobs;

use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\smsService;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SendSmsToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sms;

    /**
     * Create a new job instance.
     */
    public function __construct($sms)
    {
        $this->sms= $sms;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users= User::whereNotNull('mobile')->get();

        foreach($users as $user){

            $sms= new smsService();
            $sms->setFrom(Config::get('sms.otp_from'));
            $sms->setText($this->sms->body);
            $sms->setTo("0.$user->mobile");
            $sms->setIsFlash(true);

        }

        $messageService= new MessageService($sms);
        $messageService->send();

    }
}
