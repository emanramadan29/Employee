<?php

namespace App\Console\Commands;

use App\Mail\ManagerMail;
use App\Model\Salary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendManagerMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:mail';

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
        $totalsal=Salary::pluck('Payments_total');
        $totalsalary=$totalsal->sum();

        Mail::to('em29121992@gmail.com')->send(new ManagerMail($totalsalary));

    }
}
