<?php

namespace App\Jobs;

use App\Models\Bot;
use App\Enums\BotStatus;
use App\Jobs\GetBotUpdates;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessBotUpdates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
		Bot::where('status', BotStatus::ACTIVE)->cursor()->each(function (Bot $bot) {
			GetBotUpdates::dispatch($bot->id);
        });
    }
}
