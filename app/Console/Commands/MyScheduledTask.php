<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UserFrontendController;

class MyScheduledTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info('Scheduled task ran at: ' . now());
        UserFrontendController::chkbeforeOverdue2();
        echo 'Scheduled task ran successfully!';
    }

}

