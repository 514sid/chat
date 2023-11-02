<?php

namespace App\Jobs;

use App\Actions\GetUpdates;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GetBotUpdates implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $bot_id;

	public int $uniqueFor = 30;

	public function uniqueId(): string
    {
        return $this->bot_id;
    }

    public function __construct(int $bot_id)
    {
		$this->bot_id = $bot_id;
    }

    public function handle(): void
    {
		(new GetUpdates)($this->bot_id);
    }
}
