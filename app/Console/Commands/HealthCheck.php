<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('health:check')]
#[Description('Health Check')]
class HealthCheck extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info(__('The health check schedule is working fine!'));
        $this->info(__('The health check schedule is working fine!'));
    }
}
