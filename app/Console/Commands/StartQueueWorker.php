<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartQueueWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:start-worker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start queue worker for processing jobs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting queue worker...');
        $this->info('Press Ctrl+C to stop the worker');
        
        // Start queue worker
        $this->call('queue:work', [
            '--tries' => 3,
            '--timeout' => 60,
            '--memory' => 128
        ]);
    }
}