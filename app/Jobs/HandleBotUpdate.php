<?php

namespace App\Jobs;

use App\Models\Bot;
use App\Actions\HandleUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Services\Telegram\Types\TelegramUpdate;

class HandleBotUpdate implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public TelegramUpdate $update;
    public int $bot_id;

	public int $uniqueFor = 30;

	public function uniqueId(): string
    {
        return json_encode(
			[
				'bot_id'    => $this->bot_id,
				'update_id' => $this->update->getUpdateId()
			]
		);
    }

    public function __construct(TelegramUpdate $update, int $bot_id)
    {
		$this->update = $update;
		$this->bot_id = $bot_id;
    }

    public function handle(): void
    {
		(new HandleUpdate)($this->update, $this->bot_id);
    }
}
