<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessBotUpdates;

class ProcessBotUpdatesCommand extends Command
{
    protected $signature = 'bots:update';
    
	protected $description = 'Manually get updates for bots';

    public function handle()
    {
        $this->dispatchJob();
    }

    protected function dispatchJob()
    {
		ProcessBotUpdates::dispatch();
    }
}