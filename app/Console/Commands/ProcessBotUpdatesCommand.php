<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessBotUpdates;

class ProcessBotUpdatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bots:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually get updates for bots.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->dispatchJob();
    }

    /**
     * Dispatch the job for processing bot updates.
     */
    protected function dispatchJob()
    {
		ProcessBotUpdates::dispatch();
    }
}