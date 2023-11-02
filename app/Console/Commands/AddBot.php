<?php

namespace App\Console\Commands;

use App\Actions\CreateBot;
use App\Data\CreateBotData;
use Illuminate\Console\Command;

class AddBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bots:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually add a bot to your application by providing a bot token.';

    /**
     * Execute the console command.
     */
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
