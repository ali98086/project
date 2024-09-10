<?php

namespace App\Console\Commands;

use App\Models\User\User;
use Illuminate\Console\Command;

class ShowUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId= $this->ask('Enter User Id : ');
        echo User::find($userId)->id;
        // echo User::find($this->argument('user'))->id;
    }
}
