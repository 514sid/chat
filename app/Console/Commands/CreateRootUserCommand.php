<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Enums\UserRole;
use App\Actions\CreateUser;
use Illuminate\Support\Str;
use App\Data\CreateUserData;
use Illuminate\Console\Command;

class CreateRootUserCommand extends Command
{
    protected $signature = 'root:create';
   
	protected $description = 'Create a superuser with root privileges';

    public function handle()
    {
        $username = 'root';
        $password = Str::random(8);

        $existingRootUser = User::where('role', UserRole::ROOT)->first();

        if ($existingRootUser) {
            $this->info('Root user already exists. No need to create a new one.');
            return;
        }

        $createUserData = new CreateUserData(
            username: $username,
            password: $password,
            role: UserRole::ROOT
        );

        $user = (new CreateUser)($createUserData);

        if ($user) {
            $this->info('Root user created successfully.');
      
			$this->newLine();

			$this->table(
				['Username', 'Password'],
				[['root', $password]],
			);

			$this->newLine();

			$this->info('You can now log in to the application at ' . config('app.url') . '/login');
        } else {
            $this->error('Something went wrong.');
        }
    }
}
