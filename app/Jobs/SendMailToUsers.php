<?php

namespace App\Jobs;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    /**
     * Create a new job instance.
     */
    public function __construct($email)
    {
        $this->email= $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users= User::whereNotNull('email')->get();

        foreach($users as $user){

            $emailService= new EmailService();
            $contents= ['title'=> $this->email->subject ,'body'=>$this->email->body];
            $emailService->setContents($contents);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($user->email);
            $emailFiles = $this->email->files;
            $mailFiles = [];

            foreach($emailFiles as $emailFile){

                array_push($mailFiles, $emailFile->file_path);

            }

            $emailService->setEmailFiles($mailFiles);
            $messageService= new MessageService($emailService);
            $messageService->send();

        }
    }
}
