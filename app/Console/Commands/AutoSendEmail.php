<?php

namespace App\Console\Commands;

use App\Jobs\SendMailToUsers;
use App\Models\Notify\Email;
use Illuminate\Console\Command;

class AutoSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email To Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails= Email::where('published_at', now())->get();
        foreach($emails as $email){

            SendMailToUsers::dispatch($email);

        }
    }
}
