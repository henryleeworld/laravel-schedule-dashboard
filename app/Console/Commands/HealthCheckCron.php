<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HealthCheckCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health-check:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Health Check';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info(__('The health check schedule is working fine!'));
        $this->info(__('The health check schedule is working fine!'));
    }
}
