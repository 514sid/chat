<?php

namespace App\Console\Commands;

use App\Actions\CreateBot;
use App\Data\CreateBotData;
use Illuminate\Console\Command;

class AddBotCommand extends Command
{
    protected $signature = 'bots:add';

	protected $description = 'Manually add a bot to your application by providing a bot token';

    public function handle(CreateBot $createBotAction)
    {
        $token = $this->ask('Enter the bot token:');
        
        $botData = new CreateBotData($token);
        
        try {
            $bot = $createBotAction($botData);
            
            $this->info('Bot successfully added:');
            $this->info(json_encode($bot, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $this->error('Failed to add the bot:');
            $this->error($e->getMessage());
        }
    }
}
