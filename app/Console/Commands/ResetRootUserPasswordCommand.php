<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetRootUserPasswordCommand extends Command
{
    protected $signature = 'root:reset';
   
    protected $description = 'Reset the password for the root user';

    public function handle()
    {
        $existingRootUser = User::where('role', UserRole::ROOT)->first();

        if (!$existingRootUser) {
            $this->info('Root user does not exist.');
            return;
        }

        $password = Str::random(8);
        $existingRootUser->password = Hash::make($password);
        $existingRootUser->save();

        $this->info('Root user password reset successfully.');
        $this->newLine();
        $this->table(
            ['Username', 'New Password'],
            [['root', $password]],
        );
        $this->newLine();
        $this->info('You can now log in to the application using the updated password.');
    }
}