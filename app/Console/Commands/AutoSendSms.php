<?php

namespace App\Console\Commands;

use App\Jobs\SendSmsToUsers;
use App\Models\Notify\SMS;
use Illuminate\Console\Command;

class AutoSendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Sms To Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $smses= SMS::where('published_at', now())->get();

        foreach($smses as $sms){

            SendSmsToUsers::dispatch($sms);

        }
    
    }
}
